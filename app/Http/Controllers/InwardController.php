<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inwards;
use App\Clients;
use App\Tests; 
use App\Records; 
use DB;


class   InwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $records = \App\Records::all();
        $users = DB::select("select id,name from users where role ='engineer' ");

        $inward = DB::table('inwards')
            ->join('records','inward_id','=','records.record_inward')
            ->join('clients','inward_client','=','clients.client_id')
            ->get();

        return view('inward', ['inwards' => $inward , 'users' => $users], compact('records'));
    }

    public function archive()
    {

        $inward = DB::table('inwards')
            ->join('clients','inward_client','=','clients.client_id')
            ->leftJoin('invoices','inward_id','=','invoices.invoice_inward')
            ->get();



        return view('inward.archive', ['inwards' => $inward  ]);
    }

    public function edit($inward_id)
    {
        $inward = DB::select("select inward_id, inward_test, test_id, test_name, inward_client,inward_date, inward_report_date, client_id, client_name, client_gstin, client_address, client_email, client_phone from inwards i inner join tests t on i.inward_test = t.test_id inner join clients c on c.client_id = i.inward_client where inward_id = '$inward_id' ");
        $clients = Clients::all(['client_id','client_name']);
        $tests = Tests::all(['test_name','test_material','test_id']);
        $records = DB::table('records')
                        ->join('tests','record_test','=','tests.test_id')
                        ->leftJoin('users','record_assign_to','=','users.id')
                        ->where('record_inward',$inward_id)->get();
                        
        $users = DB::select("select id,name from users where role = 'engineer' ");
        
        return view('inward.edit', ['inwards' => $inward,'record' => $records], compact('clients', 'tests', 'records', 'users'));
    }

    public function addTest()
    {
        $inward = new Inwards;
        $reference = reference($inward);
        $key = keyGen($inward);
        $clients = Clients::all(['client_id','client_name']);
        $tests = Tests::all(['test_name','test_material','test_id']);
        $inwards = DB::select("select inward_id, inward_status, inward_client, inward_report_date, client_name from inwards i inner join clients c on i.inward_client = c.client_id  ");
        //$inwards = Inwards::all(['inward_id','inward_client']);
        return view('inward.addTest',['inwards' => $inwards ], compact('clients','tests','reference','key'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Inwards $models)
    {
        $inward = new Inwards;
        $reference = reference($inward);
        $key = keyGen($inward);
        $clients = Clients::all(['client_id','client_name']);
        $tests = Tests::all(['test_name','test_material','test_id']);
        
        return view('inward.create', compact('clients', 'tests','reference','key'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'test_qty' => 'required | numeric',
            'test_price' => 'required',
            'inward_description' => 'required'
        ]);

        $inward = new Inwards;
        $record = new Records;

        $inward_key = Keygen($inward);
        $record_key = Keygen($record);

        $inward_record = update_records('+',$inward_key,$record_key);
        //accumulate data for inward
        //$inward->inward_id = $inward_key;
        //$inward->inward_reference = $request->inward_reference; 
        //$inward->inward_client = $request->inward_client;
        //$inward->inward_test = $request->inward_test;
        //$inward->inward_date = $request->inward_date;
        //$inward->inward_report = "";
        //$inward->inward_assign_to = NULL; 
        //$inward->inward_description = $request->inward_description;
        //$inward->inward_report_date = $request->inward_report_date;
        
        
            
        //accumulate data for records
        //$record->record_id = $inward_key;
        //$record->record_inward = $record_key;
        //$record->record_test =  $request->inward_test;
        //$record->record_price = $request->test_price;
        //$record->record_qty = $request->test_qty; 
                
        
            DB::transaction(function () use ($inward, $record, $request, $inward_key, $record_key, $inward_record) {
                
                DB::table('inwards')->insert(
                    [
                        'inward_id' => Keygen($inward),
                        'inward_reference' => $request->inward_reference,
                        'inward_client' => $request->inward_client,
                        'inward_test' => $request->inward_test,
                        'inward_date' => $request->inward_date,
                        'inward_records' => $inward_record,
                        'inward_pending' => 1,
                        'inward_invoice_pending' => 1,
                        'inward_description' => $request->inward_description,
                        'inward_report_date' => $request->inward_report_date
                    ]
                );
                DB::commit();
            
                DB::table('records')->insert(
                    [
                        'record_id' => $record_key,
                        'record_inward' => $inward_key,
                        'record_test' => $request->inward_test,
                        'record_price' => $request->test_price,
                        'record_qty' => $request->test_qty
                    ]
                );

                DB::commit();
            });
        
            

        
        return redirect()->route('inward.index')->withStatus(__('Inward Registered.'));

    }

    public function assignInward($inward,$user)
    {
        //Inwards::where('inward_id',$inward)->update('inward_assign_to',$user);
        $count = Inwards::where('inward_id',$inward)->update(
            array(
                'inward_assign_to' => $user
            )
        );
        return redirect()->route('inward.index')->withStatus(__('Inward Assigned'));
    }

    
    public function assignRecord($record,$user)
    {
        //Inwards::where('inward_id',$inward)->update('inward_assign_to',$user);
        $count = Records::where('record_id',$record)->update(
            array(
                'record_assign_to' => $user
            )
        );
        return back()->withStatus(__('Test Assigned'));
    }

    public function status($inward_id,$record_id, Request $request)
    {
        $request->validate([
            'test_report_number' => 'required',
            'test_final_report' => 'required | file | mimes:xls,xlsx,docx,xltx,pdf'
        ]);

        $record_model = new Records();
        $key = keyGen($record_model);

        $final_report_filename = "final_report_".$key.".".$request->file("test_final_report")->getClientOriginalExtension();
        $final_report_directory = 'final_report';
        $final_report_file = $request->file('test_final_report')->storeAs($final_report_directory, $final_report_filename );
        $final_report_path = storage_path("app".DIRECTORY_SEPARATOR.$final_report_directory.DIRECTORY_SEPARATOR.$final_report_filename);

        $previous_inward_pendings = DB::table('inwards')->where('inward_id','=',$inward_id)->get();
        $new_inward_pending = +$previous_inward_pendings[0]->inward_pending - 1;


        DB::transaction(function () use($inward_id,$record_id,$new_inward_pending,$request,$final_report_path) {

            DB::table('records')->where('record_id',$record_id)->update(
                array(
                    'record_status' => 'Tested',
                    'record_report_number' => $request->test_report_number,
                    'record_report_file' => $final_report_path
                ));

            DB::table('inwards')->where('inward_id',$inward_id)->update(
                array(
                    'inward_pending' => $new_inward_pending
                ));

        });


        return redirect()->route('lab')->withStatus(__('Test Completed'));
    }

    public function phase(Request $request)
    {
 
        $count = DB::table('records')->where('record_id',$request->record_id)->update(
            array(
                $request->phase => 1
            ));
        return $count;
    }

    public function sendTest($inward_id)
    {
        $inward = DB::select("select inward_id, inward_test, test_id, test_name from inwards i inner join tests t on i.inward_test = t.test_id where inward_id = '$inward_id' ");
        return response()->json($inward);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function addNewRecord(Request $request)
    {
        
        $request->validate([
            'test_qty' => 'required | numeric',
            ]);
            $record = new Records;

        $record_id = Keygen($record);
        $inward_id = $request->inward_id;

        $inward_records = update_records('+',$request->inward_id,$record_id);
        $inward_pending = DB::select("select inward_pending,inward_invoice_pending from inwards where inward_id = '{$inward_id}'");
        $pending = (int)$inward_pending[0]->inward_pending + 1;
        $invoice_pending = (int)$inward_pending[0]->inward_invoice_pending + 1;



        $existing_records = retrieve_records($inward_id);
        $unique_flag = 1;



        $i = 1;
        for($i = 1; $i < count($existing_records);$i++)
        {
            $record_test = DB::select("select record_test, record_id, record_qty from records where record_id = '{$existing_records[$i-1]}'");

            $last_record_test = $record_test[$i-1]->record_test;

            if($request->inward_test == $last_record_test)
            {
                $unique_flag = 0;
                $non_unique_record = $record_test[$i-1]->record_id;
                $last_record_qty = $record_test[$i-1]->record_qty;
            }
        }

        if($unique_flag == 1)
        {
            //if record is unique
            DB::transaction(function () use ($inward_id, $record, $request, $record_id, $inward_records, $pending, $invoice_pending) {

                DB::table('inwards')
                    ->where('inward_id','=',$inward_id)
                    ->update(
                        [
                            'inward_records' => $inward_records,
                            'inward_pending' => $pending,
                            'inward_invoice_pending' => $invoice_pending,
                        ]
                    );
                DB::commit();

                DB::table('records')->insert(
                    [
                        'record_id' => $record_id,
                        'record_inward' => $inward_id,
                        'record_test' => $request->inward_test,
                        'record_price' => $request->test_price,
                        'record_qty' => $request->test_qty
                    ]
                );

                DB::commit();
            });

            return back()->withStatus(__('Test Added.'));
        }
        else
        {
            //update qty by adding last records qty into non-unique one
            $final_qty = (int)$last_record_qty + (int)$request->test_qty;

            DB::table('records')
                ->where('record_id','=',$non_unique_record)
                ->update(
                    [
                        'record_qty' => $final_qty
                    ]
                );
            return back()->withStatus(__('Test Already Exists. Updated Quantity'));
        }





    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

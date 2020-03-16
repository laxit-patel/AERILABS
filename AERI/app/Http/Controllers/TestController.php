<?php

namespace App\Http\Controllers;

use App\Tests;
use App\Materials;
use Illuminate\Http\Request;
use DB;
use Storage;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tests $model)
    {

        $tests = DB::table('tests')
            ->join('materials','test_material','=','materials.material_id')
            ->get();



        return view('test',  ['tests' => $tests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials = Materials::all(['material_id','material_name']);
        $test = new Tests;
        $key = keyGen($test);
        return view('test.create', compact('materials','key'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $test = new Tests;
        $key = keyGen($test);

        $request->validate([
            'test_worksheet' => 'required | file | mimes:xls,xlsx,xltx,pdf',
            'test_report' => 'required | file | mimes:xls,xlsx,docx,xltx,pdf',
        ]);

        
        $worksheet_filename = "worksheet_".$key.".".$request->file("test_worksheet")->getClientOriginalExtension();
        $worksheet_directory = 'test_worksheets';
        $worksheet_file = $request->file('test_worksheet')->storeAs($worksheet_directory, $worksheet_filename );
        $worksheet_path = storage_path("app".DIRECTORY_SEPARATOR.$worksheet_directory.DIRECTORY_SEPARATOR.$worksheet_filename);


        $report_filename = "report_".$key.".".$request->file("test_report")->getClientOriginalExtension();
        $report_directory = 'test_reports';
        $report_file = $request->file('test_report')->storeAs($report_directory, $report_filename );
        $report_path = storage_path("app".DIRECTORY_SEPARATOR.$report_directory.DIRECTORY_SEPARATOR.$report_filename);


        //$worksheet_filename = "worksheet_".$key.".".$request->file("test_worksheet")->getClientOriginalExtension();
        //$worksheet_file = $request->file('test_worksheet')->storeAs('worksheet_format', $worksheet_filename );
        //$worksheet_path = storage_path(DIRECTORY_SEPARATOR .$worksheet_filename);


        //Storage::disk('s3')->makeDirectory('worksheet_format');
        //$worksheet_file = Storage::disk('s3')->put($worksheet_filename, file_get_contents($request->file('test_worksheet')), 'worksheet_format');
        //$worksheet_path = Storage::disk('s3')->url($worksheet_filename);


        //$report_filename = "report_".$key.".".$request->file("test_report")->getClientOriginalExtension();

        //$report_directory = 'report_format/' . $report_filename;
        //$report_file = $request->file('test_report')->storeAs($report_directory, $report_filename );
        //$report_path = storage_path("app/".$report_directory."/".$report_filename);

        //Storage::disk('s3')->makeDirectory('report_format');
        //$report_file = Storage::disk('s3')->put($report_filename, file_get_contents($request->file('test_report')), 'report_format');
        //$report_path = Storage::disk('s3')->url($report_filename);



        $test->test_id = $key;
        $test->test_iscode = $request->test_iscode;
        $test->test_name = $request->test_name;
        $test->test_material = $request->test_material;
        $test_duration = $request->test_duration;
        $test->test_duration = $test_duration;
        $test->test_worksheet = $worksheet_path;
        $test->test_report = $report_path;
        $test->test_rate = $request->test_rate;
        $test->test_rate_mes = $request->test_rate_mes;
        $test->save();

        return redirect()->route('test.index')->withStatus(__('Test Added successfully.'));

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
    public function edit($id)
    {
        //
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

    public function ajax(Request $request,$id)
    {

        $rate_exist = DB::table('rates')
            ->where('rate_test',$id)
            ->where('rate_client',$request->client)
            ->count();

        if($rate_exist)
        {
            $data = DB::table('tests')
                ->join('materials','material_id','=','tests.test_material')
                ->where('test_id',$id)
                ->get();

            $ratelist = DB::table('rates')
                ->where('rate_test',$id)
                ->where('rate_client',$request->client)
                ->get();

            //alter data and inject client rate list

            $data[0]->test_rate = $ratelist[0]->rate_price;

            return $data;
        }
        else{
            $data = DB::table('tests')
                ->join('materials','material_id','=','tests.test_material')
                ->where('test_id',$id)
                ->get();
            return $data;
        }
    }

    public function phase(Request $request)
    {
        $count = Tests::where('test_id',$request->test_id)->update(
            array(
                $request->phase => 1
            )
        );
        return $count;
    }
}

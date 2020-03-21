<?php

namespace App\Http\Controllers;

use App\User;
use App\Clients;
use DB;
use App\Rules\GSTIN;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Clients $model)
    {
        return view('client', ['clients' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = new Clients;
        $key = keyGen($client);
        return view('client.create', [ 'key' => $key]);
    }

    public function ledger($client_id)
    {
        $clients = DB::table('clients')->where('client_id','=',$client_id)->get();

        $inwards = DB::table('clients')
            ->join('inwards', 'client_id','=','inwards.inward_client')
            ->where('client_id','=',$client_id)->get();

        $rates = DB::table('clients')
            ->join('rates', 'client_id','=','rates.rate_client')
            ->where('client_id','=',$client_id)->get();

        $invoices = DB::table('clients')
            ->join('invoices', 'client_id','=','invoices.invoice_client')
            ->where('client_id','=',$client_id)->get();

        $payments = DB::table('clients')
            ->join('payments', 'client_id','=','payments.payment_client')
            ->Leftjoin('transactions','payment_transaction','=','transactions.transaction_id')
            ->where('client_id','=',$client_id)->get();

        $credit = DB::table('transactions')->where('transaction_type','=','Credit')->where('transaction_client','=',$client_id)->sum('transaction_amount');
        $debit = DB::table('transactions')->where('transaction_type','=','Debit')->where('transaction_client','=',$client_id)->sum('transaction_amount');

        $stat_tests = DB::table('inwards')
                        ->Leftjoin('records','inward_id','records.record_inward')
                        ->Leftjoin('tests','record_test','tests.test_id')
                        ->where('inward_client','=',$client_id)
                        ->count();

        $stat_invoices = DB::table('invoices')->where('invoice_client','=',$client_id)->count();

        return view('client.ledger',compact('clients','inwards', 'rates', 'invoices', 'payments','credit','debit','stat_tests','stat_invoices'));
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
         'client_name' => 'required',
         'client_phone' => 'required | numeric | min:10 | max:12',
         'client_email' => 'required | email',
         'client_gstin' => ['required', new GSTIN],
        ]);

        $client = new Clients;
        
        $client->client_id = keyGen($client);
        
        $client->client_name = $request->client_name;
        $client->client_phone = $request->client_phone;
        $client->client_email = $request->client_email;
        $client->client_address = $request->client_address;
        $client->client_gstin = $request->client_gstin;

      $client->save();

        return redirect()->route('client.index')->withStatus(__('Client successfully created.'));
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
}

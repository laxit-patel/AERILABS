<?php

namespace App\Http\Controllers;

use DB;
use App\Invoice;
use App\Transactions;
use App\Clients;
use App\Payment;
use Illuminate\Http\Request;
use NumberToWords\NumberToWords;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice = DB::table('invoices')
            ->join('inwards','invoice_inward','=','inwards.inward_id')
            ->join('clients','invoice_client','=','clients.client_id')
            ->get();
        return view('invoice',['invoices' => $invoice]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoice = new Invoice();
        $key = keyGen($invoice);
        $clients = Clients::all(['client_id','client_name']);
        return view('accounts/create',['key' => $key,'clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = new Transactions();
        $transaction_key = Keygen($transaction);

        $invoice = new Invoice();
        $invoice_key = Keygen($invoice);

        $client_data = DB::table('clients')
            ->where('client_id',$request->invoice_clients)
            ->get();

        $receivable = $client_data[0]->client_receivable;
        $invoice_receivable = $receivable + $request->invoice_total;

        $old_record = DB::table('records')->where('record_inward',$request->invoice_inward)->count();
        $count_record = (int)$old_record - (int)$request->invoice_item_counter;


        DB::transaction(function () use ($request, $invoice_key, $transaction_key, $invoice_receivable, $count_record) {

            DB::table('invoices')->insert(
                [
                    'invoice_id' => $invoice_key,
                    'invoice_inward' => $request->invoice_inward,
                    'invoice_client' => $request->invoice_clients,
                    'invoice_amount' => $request->invoice_amount,
                    'invoice_tax' => $request->invoice_tax,
                    'invoice_qty' => $request->invoice_qty,
                    'invoice_total' => $request->invoice_total,
                    'invoice_type' => "GST",
                    'invoice_status' => "Unpaid",
                ]
            );

            DB::table('transactions')->insert(
                [
                    'transaction_id' => $transaction_key,
                    'transaction_invoice' => $invoice_key,
                    'transaction_client' => $request->invoice_clients,
                    'transaction_type' => "Debit",
                    'transaction_amount' => $request->invoice_total,
                ]
            );

            DB::table('clients')
                ->where('client_id',$request->invoice_clients)
                ->update(
                    [
                        'client_receivable' => $invoice_receivable
                    ]
                );

            DB::table('records')
                ->where('record_inward',$request->invoice_inward)
                ->update(
                [
                    'record_invoice' => $invoice_key
                ]
            );

            DB::table('inwards')
                ->where('inward_id',$request->invoice_inward)
                ->update(
                    [
                        'inward_invoice_pending' => $count_record
                    ]
                );


        });

        return redirect()->route('invoice.index')->withStatus(__('Invoice Generated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    public function view($invoice_id)
    {
        $invoice = DB::table('invoices')
            ->join('clients','invoice_client','=','clients.client_id')
            ->join('records','invoice_inward','=','records.record_inward')
            ->where('invoice_id',$invoice_id)
            ->get();

        $item = DB::table('records')
            ->join('inwards','record_inward','=','inwards.inward_id')
            ->join('tests','record_test','=','tests.test_id')
            ->where('record_invoice','=',$invoice_id)
            ->get();

        // create the number to words "manager" class
        $numberToWords = new NumberToWords();

        // build a new number transformer using the RFC 3066 language identifier
        $numberTransformer = $numberToWords->getNumberTransformer('en');

        $amount_in_words = $numberTransformer->toWords($invoice[0]->invoice_total);

        return view('accounts.view', ['invoices' => $invoice, 'items' => $item, 'amount_in_word' => $amount_in_words]);
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

    public function getInwardsForClient($client_id)
    {

        $inwards = DB::table('inwards')->join('clients', 'inward_client','=','clients.client_id')
            ->where('inward_client', '=', $client_id )
            ->where('inward_pending','=',0)
            ->get();




        return $inwards;
    }

    public  function pay($invoice_id)
    {
        $model = new Payment();
        $key = keyGen($model);

        $invoices = DB::table('invoices')->
            join('inwards','invoice_inward','=','inwards.inward_id')
            ->join('transactions','invoice_id','=','transactions.transaction_invoice')
            ->where('invoice_id','=',$invoice_id)
            ->get();

        return view('accounts.pay',['invoices' => $invoices, 'key' => $key]);
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

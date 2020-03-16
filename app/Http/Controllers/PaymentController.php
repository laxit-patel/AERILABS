<?php

namespace App\Http\Controllers;

use App\Http\Kernel;
use App\Payment;
use App\Transactions;
use App\Mode;
use DB;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */

    public function ProcessPayment(Request $request)
    {
        $payment_model = new Payment();
        $payment_id = keyGen($payment_model);

        $mode_model = new Mode();
        $mode_id = keyGen($mode_model);

        $transaction_model = new Transactions();
        $transaction_id = keyGen($transaction_model);

        $client_data = DB::table('clients')
            ->where('client_id',$request->payment_client)
            ->get();

        $receivable = $client_data[0]->client_receivable;
        $invoice_receivable = +$receivable - +$request->payment_mode_amount;


        DB::transaction(function () use($payment_id,$mode_id,$transaction_id,$request,$invoice_receivable) {

            DB::table('payments')->insert(
                [
                    'payment_id' => $payment_id,
                    'payment_mode' => $mode_id,
                    'payment_client' => $request->payment_client,
                    'payment_invoice' => $request->payment_invoice,
                    'payment_transaction' => $request->payment_transaction,
                    'payment_date' => $request->payment_mode_check_date
                ]
            );

            DB::table('modes')->insert(
                [
                    'mode_id' => $mode_id,
                    'mode_type' => $request->payment_method,
                    'mode_bank' => $request->payment_mode_bank_name,
                    'mode_date' => $request->payment_mode_check_date,
                    'mode_entity' => $request->payment_client,
                    'mode_amount' => $request->payment_mode_amount,
                    'mode_description' => $request->payment_mode_description,
                    'mode_reference' => $request->payment_mode_check_number,
                ]
            );

            DB::table('transactions')->insert(
                [
                    'transaction_id' => $transaction_id,
                    'transaction_invoice' => $request->payment_invoice,
                    'transaction_client' => $request->payment_client,
                    'transaction_type' => 'Credit',
                    'transaction_amount' => $request->payment_mode_amount
                ]
            );

            DB::table('invoices')->where('invoice_id',$request->payment_invoice)
                ->update(
                    [
                        'invoice_status' => 'Paid'
                    ]
                );

            DB::table('clients')->where('client_id',$request->payment_client)
                ->update(
                    [
                        'client_receivable' => $invoice_receivable
                    ]
                );

        });
        return redirect('/ledger')->withStatus(__('Invoice Paid'));
    }

    public function destroy(Payment $payment)
    {
        //
    }
}

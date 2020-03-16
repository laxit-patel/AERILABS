<?php

namespace App\Http\Controllers;

use App\Rates;
use App\Clients;
use App\Tests;
use DB;
use Validator;
use Illuminate\Http\Request;

class RatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Clients::all(['client_id','client_name']);
        $tests = Tests::all(['test_id','test_name']);
        return view('accounts.rates', ['clients' => $clients,'tests' => $tests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'rates_client' => 'required',
            'rates_test' => 'required',
            'rates_rates' => 'required | numeric',
        ]);

        $rate_counter = DB::table('rates')
            ->where('rate_client',$request->rates_client)
            ->where('rate_test',$request->rates_test)
            ->count();

        if($rate_counter != 0)
        {
            return redirect()->route('rates')->with('error', 'Rates Already Exists');
        }
        else
        {
            $rates_model = new Rates();
            $key = keyGen($rates_model);

            DB::table('rates')->insert(
                [
                    'rate_id' => $key,
                    'rate_client' => $request->rates_client,
                    'rate_test' => $request->rates_test,
                    'rate_price' => $request->rates_rates
                ]
            );

            return redirect()->route('rates')->withStatus(__('Rates Included'));
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rates  $rates
     * @return \Illuminate\Http\Response
     */
    public function show(Rates $rates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rates  $rates
     * @return \Illuminate\Http\Response
     */
    public function edit(Rates $rates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rates  $rates
     * @return \Illuminate\Http\Response
     */
    public function updateRates(Request $request)
    {
        $request->validate([

        ]);

        $validator = Validator::make($request->all(), [
            'modal_client_id' => 'required',
            'modal_test_id' => 'required',
            'modal_test_price' => 'required | numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('rates')->with('error', 'Only Numbers Are Allowed');
        }
        else
        {
            DB::table('rates')
                ->where('rate_client',$request->modal_client_id)
                ->where('rate_test', $request->modal_test_id)
                ->update(
                    [
                        'rate_price' => $request->modal_test_price
                    ]
                );
            return redirect()->route('rates')->withStatus(__('Rates Included'));
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rates  $rates
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rates $rates)
    {
        //
    }

    public function getRatesForClient(Request $request)
    {
         $rates = DB::table('rates')
             ->join('clients','rate_client','=','clients.client_id')
             ->join('tests','rate_test','=','tests.test_id')
             ->where('rate_client','=',$request->client_id)
             ->get();

         return $rates;


    }
}

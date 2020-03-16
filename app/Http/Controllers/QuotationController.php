<?php

namespace App\Http\Controllers;

use DBlackborough\Quill\Render;
use Illuminate\Http\Request;
use App\Clients;
use App\Quotations;
use App\Tests;
use DB;

class QuotationController extends Controller
{

    public function index()
    {
        return view('quotation');
    }

    public function create()
    {
        $quotation_object = new Quotations();
        $key = keyGen($quotation_object);
        $clients = Clients::all(['client_id','client_name']);
        $tests = Tests::all(['test_name','test_material','test_id']);
        return view('quotation.create',compact('clients','key', 'tests'));
    }

    public function processDraft(Request $request)
    {
        $quotation_object = new Quotations();
        $key = keyGen($quotation_object);
        $quotation_id = $key;
        $quotation_client = $request->quotation_client;
        $quotation_items = json_encode($request->quotation_items);
        $quotation_terms = $request->quotation_terms;
        $quotation_type = 'Draft';
        $quotation_stack = "NULL";


        DB::table('quotations')->insert(
            [
                'quotation_id' => $key,
                'quotation_client' => $quotation_client,
                'quotation_items' => $quotation_items,
                'quotation_terms' => $quotation_terms,
                'quotation_type' => $quotation_type,
                'quotation_stack' => $quotation_stack
            ]
        );

        $decode = json_decode($quotation_items);
        $items = array();
        foreach ($decode as $item)
        {
            $data = DB::table('tests')->where('test_id',$item)->get();
            array_push($items,$data);

        }

        //logic to render terms & conditions stored in json format
        //try {
        //    $quill = new Render($quotation_terms, 'HTML');
        //    $result = $quill->render();
        //} catch (\Exception $e) {
        //    echo $e->getMessage();
        //}
        //echo $quill_json

        $quill = new Render($quotation_terms, 'HTML');
        $terms = $quill->render();

        $quotation = DB::table('quotations')->where('quotation_id',$key)->get();
        return response()->view('quotation.generate', ['quotation' => $quotation,'items' => $items,'terms' => $terms]);

    }

    public function generate(){
        $quotation_object = new Quotations();
        $key = keyGen($quotation_object);
        $clients = Clients::all(['client_id','client_name']);
        $tests = Tests::all(['test_name','test_material','test_id']);
        return view('quotation.generate',compact('clients','key', 'tests'));
    }


}
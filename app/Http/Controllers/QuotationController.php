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
        echo $key."<br>";

        $quotation_id = keyGen($quotation_object);
        $quotation_client = $request->quotation_client;
        $quotation_items = json_encode($request->quotation_items);
        $quotation_terms = $request->quotation_terms;
        $quotation_type = 'Draft';
        $quotation_stack = "NULL";


        dd();

        //logic to render terms & conditions stored in json format
        //try {
        //    $quill = new Render($quotation_terms, 'HTML');
        //    $result = $quill->render();
        //} catch (\Exception $e) {
        //    echo $e->getMessage();
        //}
        //echo $quill_json;





    }
}
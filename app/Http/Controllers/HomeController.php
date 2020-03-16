<?php

namespace App\Http\Controllers;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $tests = DB::table('records')
            ->join('users','record_assign_to','=','users.id')
            ->get();



        return view('dashboard',compact('tests'));
    }
}

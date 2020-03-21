<?php

namespace App\Http\Controllers;
use DB;
use Carbon\Carbon;

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


        $current_date_time = Carbon::now()->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"

        return view('dashboard',compact('tests', 'current_date_time'));
    }
}

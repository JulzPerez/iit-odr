<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $request_count = DB::table('requests')
                    ->where('request_status','pending')
                    ->count();  
                    
        $userid = \Auth::user()->id;
        $myrequest_count = DB::table('requestor')
                    ->join('requests', 'requests.requestor_id', '=', 'requestor.id')
                    ->where('requestor.user_id',$userid)
                    ->count();

        return view('home', compact('request_count','myrequest_count'));
    }
}

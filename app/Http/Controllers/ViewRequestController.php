<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //dd($request_status);
        if(\Gate::allows('isAdmin') || \Gate::allows('isStaff'))
        {
           $requests = DB::table('requestor')
            ->join('requests', 'requests.requestor_id', '=', 'requestor.id')
            ->join('documents', 'documents.id', '=', 'requests.document_id')
            ->select('requestor.*','requests.id as request_id','requests.*', 'documents.*')
            //->where('requests.request_status',$request->request_status)         
            ->get(); 

            $from_date = date('m-d-Y');
            $to_date = date('m-d-Y');

            //dd($from);

            //$requests = [];
            return view('Requests', compact('requests','from_date','to_date'));
        }        
    }

    public function viewRequestByStatus($request_status)
    {
        //dd($request_status);
        if(\Gate::allows('isAdmin') || \Gate::allows('isStaff'))
        {
            $from_date = date('m-d-Y'); 
            $to_date = date('m-d-Y');

            $requests = DB::table('requestor')
            ->join('requests', 'requests.requestor_id', '=', 'requestor.id')
            ->join('documents', 'documents.id', '=', 'requests.document_id')
            ->select('requestor.*','requests.id as request_id','requests.*', 'documents.*')
            ->where('requests.request_status',$request_status)         
            ->get(); 
             
            return view('Requests', compact('requests','from_date','to_date'));
        }        
    }

    public function filterRequest(Request $request)
    {
       
        if(\Gate::allows('isAdmin') || \Gate::allows('isStaff'))
        {
            $from_date = date('Y-m-d', strtotime($request['from_date'])); 
            $to_date = date('Y-m-d', strtotime($request['to_date']));

            $requests = DB::table('requestor')
            ->join('requests', 'requests.requestor_id', '=', 'requestor.id')
            ->join('documents', 'documents.id', '=', 'requests.document_id')
            ->select('requestor.*','requests.id as request_id','requests.*', 'documents.*')
            ->where('requests.request_status',$request['request_status']) 
            ->whereDate('requests.created_at', '>=', $from_date) 
            ->whereDate('requests.created_at', '<=', $to_date)       
            ->get(); 
             //array($request->from_date,$request->to_date)
            //dd($requests);

            $from = date('d-m-Y', strtotime($request['from_date']));
            $to = date('d-m-Y', strtotime($request['to_date']));

            return view('Requests', compact('requests','from','to'));
        }        
    }
}

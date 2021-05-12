<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Document;
use App\DocRequest;


class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = \Auth::user()->id;

        $all_request = DB::table('requestor')
            ->join('requests', 'requests.requestor_id', '=', 'requestor.id')
            ->join('documents', 'documents.id', '=', 'requests.document_id')
            ->select('requests.*', 'documents.*','requests.id as request_id', 'requestor.id as requestor_id')
            ->where('requestor.user_id',$userid)
            ->get();
        
        return view('request.index', compact('all_request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userid = \Auth::user()->id;
        
        if (DB::table('requestor')->where('user_id', $userid )->doesntExist() ) 
        {
            return redirect('/requester')->with('message', 'You must fill-in some information first below before you can create the request!');  
        }
        else
        {
            $docs = Document::all();        

            return view('request.create', compact('docs'));
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userid = \Auth::user()->id;
        $requestor_id = DB::table('requestor')
                        ->where('user_id', $userid)
                        ->first()->id;
       // dd($request);

        
       DocRequest::create([
            'requestor_id' => $requestor_id,
            'document_id' => $request['docID'],
            'number_of_copy' => $request['copy']
        ]); 

        return redirect('/request')->with('success', 'Request added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $request_id = $id;

            $assessments = DB::table('assessment_of_fees')
            ->leftJoin('fees', 'fees.id', '=', 'assessment_of_fees.fees_id')
            ->select('fees.id as f_id','fees.fee_name as f_name','fees.unit as f_unit','fees.amount as f_amount', 'assessment_of_fees.*')
            ->where('assessment_of_fees.requests_id',$id)
            ->get();

            $total = collect($assessments)->sum('amount');

            return view('request.show', compact('assessments','total'));

            //dd($assessments);
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

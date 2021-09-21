<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Fee;
use App\Assessment;
use App\DocRequest;
use Carbon\Carbon;

class AssessmentController extends Controller
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
        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff'))
        {

            $requests = DB::table('requestor')
            ->join('requests', 'requests.requestor_id', '=', 'requestor.id')
            ->join('documents', 'documents.id', '=', 'requests.document_id')
            ->select('requestor.*','requests.id as request_id','requests.*', 'documents.*')
            ->where('requests.request_status','pending')         
            ->get();

             return view('assessment.index', compact('requests'));
        }        
    }

    public function getAssessment(Request $request)
    {   
        try
        {
            $assessments = DB::table('assessment_of_fees')
                ->where('requests_id',$request['request_id'])
                ->get();

            return \Response::json($assessments);
        }
        catch(\Exception $exception)
        {
            throw new \App\Exceptions\ExceptionLogData($exception);
        }        

    }

        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff'))
        {
            $this->validate($request, [
                'fee_id' => 'required',
                'copy' => 'required|numeric|gt:0',
                'pages' => 'required|numeric|gt:0',               
    
            ]);
            
            $fee_id = $request['fee_id'];
            $request_id = $request['request_id'];
            $fee = Fee::where('id',$fee_id)->first()->toArray();
                        
            $subtotal = $request['copy'] * $request['pages'] * $fee['amount'];

            Assessment::create([
                'fees_id' => $request['fee_id'],
                'requests_id' => $request['request_id'],
                'number_of_copy' => $request['copy'],
                'number_of_pages' => $request['pages'],
                'amount' => $subtotal
            ]); 


            //Update request 
            $request = DocRequest::where('id',$request_id)->first();
        
            $assessment = $request->assessment_total + $subtotal;
            $request->assessment_total = $assessment;

            $request->request_status = "assessed";
            $request->assessed_by = \Auth::user()->first_name.' '.\Auth::user()->last_name;
            $request->assessed_date = Carbon::now();
            $request->save();
            
            return redirect()->route('assessments.show',$request_id);
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff')){

            $request_id = $id;

            $request_info = DB::table('requestor')
            ->join('requests', 'requests.requestor_id','=', 'requestor.id')
            ->join('documents','requests.document_id','=','documents.id')
            ->select('requestor.*','requests.*','documents.*')
            ->where('requests.id',$request_id)
            ->first();

            //dd($request_info);

            $assessments = DB::table('assessment_of_fees')
            ->join('fees', 'fees.id', '=', 'assessment_of_fees.fees_id')
            ->select('fees.id as f_id','fees.fee_name as f_name','fees.unit as f_unit','fees.amount as f_amount', 'assessment_of_fees.*')
            ->where('assessment_of_fees.requests_id',$request_id)
            ->get();

            $ids = collect($assessments)->pluck('fees_id');
            $fees = Fee::whereNotIn('id',$ids)->get(); 
            
            $total = collect($assessments)->sum('amount');
        
            return view('assessment.show', compact('request_info','assessments','fees','total','request_id' ));
        } 
    }

    //public function

  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $request_id = \Request::get('request_id');
        $pages = $request->get('pages');
        $amount = $request->get('amount');

        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff')){
            $this->validate($request, [
                'pages' => 'required|integer|min:1|gt:0',              
    
            ]);
    
            $fee = Assessment::where('requests_id',$request_id)->where('fees_id',$id)->first();
            
            $fee->number_of_pages = $pages;
            $fee->amount = $pages * $amount;
            $fee->save();
    
            return redirect()->route('assessments.show',$request_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff')){
            $request_id = \Request::get('request_id');
            
            $fee = Assessment::where('requests_id',$request_id)->where('fees_id',$id)->first();
            //dd($fee);
            $fee->delete();

            return redirect()->route('assessments.show',$request_id);
        }
    }

    
}

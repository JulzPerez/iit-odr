<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Fee;
use App\Assessment;
use App\DocRequest;

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
        if(\Gate::allows('isAdmin') || \Gate::allows('isStaff'))
        {
            $requests = DB::table('requestor')
            ->join('requests', 'requests.requestor_id', '=', 'requestor.id')
            ->join('documents', 'documents.id', '=', 'requests.document_id')
            ->select('requestor.*','requests.id as request_id','requests.*', 'documents.*')
            ->get();
        
            return view('assessment.index', compact('requests'));
        }
        
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
        //dd($request->all());
        if(\Gate::allows('isAdmin') || \Gate::allows('isStaff'))
        {
            $request_id = $request['request_id'];
            $fee_ids = $request['fee_id'];
            $fees = Fee::whereIn('id',$fee_ids)->get()->toArray();
            
            $mydata=[];
            foreach($fees as $fee)
            {
                $mydata[] = [
                    'requests_id' => $request_id,
                    'fees_id' => $fee['id'],
                    'number_of_copy' => 1,
                    'number_of_pages' => 1,
                    'amount' =>  $fee['amount']
                ];
            }           
            Assessment::insert($mydata);

            $request = DocRequest::where('id',$request_id)->first();
            
            $request->request_status = "assessed";
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
        
        if(\Gate::allows('isAdmin') || \Gate::allows('isStaff')){

            $request_id = $id;

            $assessments = DB::table('assessment_of_fees')
            ->join('fees', 'fees.id', '=', 'assessment_of_fees.fees_id')
            ->select('fees.id as f_id','fees.fee_name as f_name','fees.unit as f_unit','fees.amount as f_amount', 'assessment_of_fees.*')
            ->where('assessment_of_fees.requests_id',$request_id)
            ->get();

            $ids = collect($assessments)->pluck('fees_id');
            $fees = Fee::whereNotIn('id',$ids)->get(); 
            
            $total = collect($assessments)->sum('amount');
        
            return view('assessment.show', compact('assessments','fees','total','request_id' ));
        } 
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
        $request_id = \Request::get('request_id');
        $pages = $request->get('pages');
        $amount = $request->get('amount');

        if(\Gate::allows('isAdmin') || \Gate::allows('isStaff')){
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
        $request_id = \Request::get('request_id');

        if(\Gate::allows('isAdmin') || \Gate::allows('isStaff')){
            $fee = Assessment::where('requests_id',$request_id)->where('fees_id',$id)->first();
            //dd($fee);
            $fee->delete();

            return redirect()->route('assessments.show',$request_id);
        }
    }
}
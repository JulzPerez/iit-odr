<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Document;
use App\DocRequest;
use App\File;
use Session;


class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
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

            try{
                $requests = DB::table('requestor')
                    ->join('requests', 'requests.requestor_id', '=', 'requestor.id')
                    ->join('documents', 'documents.id', '=', 'requests.document_id')
                    ->select('requestor.*','requestor.id as requestor_id','requests.id as request_id','requests.*', 'documents.*','requests.created_at as request_date')
                    ->where('requests.request_status','pending')  
                    ->orWhere('requests.request_status','paid')
                    ->get(); 

                $pendingRequests = $requests->filter(function ($pending) {
                    return $pending->request_status == 'pending';
                });

                $paidRequests = $requests->filter(function ($paid) {
                    return $paid->request_status == 'paid';
                });
                
            }
            catch(\Exception $exception)
            {
                throw new \App\Exceptions\ExceptionLogData($exception);
            }

            return view('request.windowStaff', compact('requests','pendingRequests','paidRequests'));
        }

        if(\Gate::allows('isRequester') )
        {
            try{
                $userid = \Auth::user()->id;
    
                $all_request = DB::table('requestor')
                            ->join('requests', 'requests.requestor_id', '=', 'requestor.id')
                            ->join('documents', 'documents.id', '=', 'requests.document_id')
                            ->select('requests.*', 'documents.*','requests.id as request_id', 'requestor.id as requestor_id','requests.created_at as request_date')
                            ->where('requestor.user_id',$userid)
                            ->orderBy('requests.created_at', 'desc')
                            ->get();

                return view('request.index', compact('all_request'));

            }
            catch(\Exception $exception)
            {
                throw new \App\Exceptions\ExceptionLogData($exception);
            }  
        }
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
       
        $docKey = explode(',',$request['docID']);

        if($docKey[1]==1)
        {
            $validator = Validator::make($request->all(),[

                'copy' => 'required|numeric|gt:0',
                'request_purpose' => 'required|string|max:255',
                'filename' => 'required',
                'filename.*' => 'mimes:pdf',
            ],
            [
                'copy.gt' => "Input must be number greater than 0.",
                'request_purpose.required' => 'Please write the purpose of request.',
                'filename.required' => 'Uploading of file is required for this document request!',
            ]);
        }
        else{
            $validator = Validator::make($request->all(),[

                'copy' => 'required|numeric|gt:0',
                'request_purpose' => 'required|string|max:255',
            ],
            [
                'copy.gt' => "Input must be number greater than 0.",
                'request_purpose.required' => 'Please write the purpose of request.',
            ]);
        }
                               

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            try
            {
                $userid = \Auth::user()->id;
                $requestor_id = DB::table('requestor')
                                ->where('user_id', $userid)
                                ->first()->id;

                if($docKey[3]==1)
                {
                    $request_status = 'assessed';
                    $assessed_by = 'auto assessed';
                    $assessed_date = Carbon::now();
                }
                else 
                {
                    $request_status = 'pending';
                    $assessed_by = '';
                    $assessed_date = null;
                }
               
                $requestID = DB::table('requests')->insertGetId(
                    [
                        //'requestor_id' => 1000,
                        'requestor_id' => $requestor_id,
                        'document_id' => $docKey[0],
                        'number_of_copy' => $request['copy'],
                        'assessment_total' => $request['copy'] * $docKey[2],
                        'assessed_by' => $assessed_by,
                        'assessed_date' => $assessed_date,
                        'purpose_of_request' => $request['request_purpose'],
                        'request_status' => $request_status,
                        'created_at' => Carbon::now(),
                        
                    ]
                );                        

                if($docKey[1]==1)
                {
                   
                    $user_fname = \Auth::user()->first_name;
                    $user_lname = \Auth::user()->last_name;
                
                        if($requestID)
                        {
                            if($request->hasfile('filename'))
                            {
                                foreach($request->file('filename') as $file)
                                {
                                    $fname = $user_fname.'_'.$user_lname.'_'.time().'_'.$file->getClientOriginalName();            
                                    // File upload location

                                    $path = $file->storeAs('file_upload', $fname);
                                    //dd($path);

                                    $file_data[] = $fname; 
                                }
                            }

                            $dataset = [];
                            foreach($file_data as $data)
                            {
                                $dataset[] = [
                                    'request_id' => $requestID,
                                    'filename' => $data,
                                ];
                            }
                            $file_insert = DB::table('request_files')->insert($dataset);
                        }
                    
                }    
            }
            catch(\Exception $exception)
            {
                throw new \App\Exceptions\ExceptionLogData($exception);
            }        
                 
        }

        if($requestID){

            Session::flash('success', 'Request has been successfully added!');
            return response()->json(['status'=>1, 'msg'=>'The request has been successfully added!']);
        }
        else{
            Session::flash('error', 'Something went wrong!');
            return response()->json(['status'=>0, 'msg'=>'Something went wrong!']);
        }        

    }

    public function getRequests($status)
    {
       
        try{
            $requests = DB::table('requestor')
                ->join('requests', 'requests.requestor_id', '=', 'requestor.id')
                ->join('documents', 'documents.id', '=', 'requests.document_id')
                ->select('requestor.*','requestor.id as requestor_id','requests.id as request_id','requests.*', 'documents.*','requests.created_at as request_date')
                ->where('requests.request_status',$status)  
                ->get(); 
            
        }
        catch(\Exception $exception)
        {
            throw new \App\Exceptions\ExceptionLogData($exception);
        }

        return view('request.windowStaff', compact('requests','status'));
       
    }

    public function updatePages(Request $request)
    {
        $this->validate($request, [
            'pages' => 'required|numeric|gt:0',
        ]);


        try{
            $updateRequest = DocRequest::find($request['requestID']);

            $copy = $updateRequest->number_of_copy;
            $pages = $request['pages'];
            $fee = $request['docFee'];

            $updateRequest->number_of_pages = $request['pages'];
            $updateRequest->assessed_by = \Auth::user()->first_name .' '. \Auth::user()->last_name;
            $updateRequest->assessed_date = Carbon::now();
            $updateRequest->assessment_total =  $copy * $pages * $fee;
            $updateRequest->request_status = 'assessed';

            $updateRequest->save();
        }
        catch(\Exception $exception)
        {
            throw new \App\Exceptions\ExceptionLogData($exception);
        } 

        if($updateRequest){

            Session::flash('success', 'Request has been assessed!');
            return response()->json(['status'=>1, 'msg'=>'Assessed successfully!']);
        }
        else{
            Session::flash('error', 'Something went wrong!');
            return response()->json(['status'=>0, 'msg'=>'Something went wrong!']);
        } 
    }

      
    /* public function show($id)
    {
            $request_id = $id;

            $assessments = DB::table('assessment_of_fees')
            ->leftJoin('fees', 'fees.id', '=', 'assessment_of_fees.fees_id')
            ->select('fees.id as f_id','fees.fee_name as f_name','fees.unit as f_unit','fees.amount as f_amount', 'assessment_of_fees.*')
            ->where('assessment_of_fees.requests_id',$id)
            ->get();

            $total = collect($assessments)->sum('amount');

            $payment_status = DB::table('requests')
                ->select('payment_status')
                ->where('id',$id)->value('payment_status');

            //dd($payment_status);

            return view('request.show', compact('assessments','total','payment_status'));

            //dd($assessments);
    } */

       
    
}

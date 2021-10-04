<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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
                        ->join('requests', 'requestor.id', '=', 'requests.requestor_id')
                        ->join('documents', 'documents.id', '=', 'requests.document_id')                      
                        ->select('requestor.*','requestor.id as requestor_id','requests.id as request_id','requests.*', 'documents.*','requests.created_at as request_date') 
                        ->whereNotIn('requests.request_status',['completed'])
                        ->orderBy('request_date', 'asc')
                        ->paginate(10); 

                $pending = $requests->filter(function ($pending) {
                    return $pending->request_status == 'pending';
                });
                $pendingRequests = $pending->all();

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

        if(\Gate::allows('isProcessor') )
        {
            try{
                $user_id = \Auth::user()->id;

                $requests = DB::table('requestor')
                        ->join('requests', 'requestor.id', '=', 'requests.requestor_id')
                        ->join('documents', 'documents.id', '=', 'requests.document_id')
                        ->join('work_assignment', 'requests.id','=','work_assignment.request_id')
                        ->select('requestor.*','requestor.id as requestor_id','requests.id as request_id','requests.*', 'documents.*','requests.created_at as request_date')
                        ->where('requests.request_status','processing') 
                        ->where('work_assignment.user_id',$user_id) 
                        ->orderBy('work_assignment.created_at', 'desc')
                        ->get(); 
                //dd($requests);
              
            }
            catch(\Exception $exception)
            {
                throw new \App\Exceptions\ExceptionLogData($exception);
            }

            return view('workAssignment.assignedWork', compact('requests'));
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
                'filename' => 'required|max:1024',
                'filename.*' => 'mimes:pdf',
            ],
            [
                'copy.gt' => "Input must be number greater than 0.",
                'request_purpose.required' => 'Please write the purpose of request.',
                'filename.required' => 'Please upload file for this document request!',
                'filename.*.mimes' => 'The file must be a file of type: pdf',
                'filename.*.max' => 'File must only be <= 512KB'
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
        else
        {
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
                            $file_data = [];

                            if($request->hasfile('filename'))
                            {                               

                                foreach($request->file('filename') as $file)
                                {
                                    $fname = time().'_'.$file->getClientOriginalName();            
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
                        else{
                            Session::flash('error', 'Something went wrong adding request. Please report this to the administrator.');
                            return response()->json(['status'=>0, 'msg'=>'Something went wrong.']);
                        }
                    
                }    
            }
            catch(\Exception $exception)
            {
                throw new \App\Exceptions\ExceptionLogData($exception);
            }   
            
            if($requestID){

                Session::flash('success', 'Request has been successfully added!');
                return response()->json(['status'=>1, 'msg'=>'The request has been successfully added!']);
            }
                 
        }       

    }

    

    public function updatePages(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'pages' => 'required|numeric|gt:0',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else
        {
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
        }

        if($updateRequest){

            Session::flash('success', 'Request has been assessed!');
            return response()->json(['status'=>1, 'msg'=>'Assessed successfully!']);
        }
      
    }

    public function getAttachments($id)
    {
        try
        {
            $attachments = DB::table('request_files')
                ->where('request_id',$id)
                ->get();
        }
        catch(\Exception $exception)
        {
            throw new \App\Exceptions\ExceptionLogData($exception);
        } 

        if($attachments)
        {
            $html = '';
    
            if(!$attachments->isEmpty())
            {
                foreach ($attachments as $attachment) 
                {
                    $html .=    '<tr>                                
                                    <td>'.$attachment->filename. '</td>
                                    <td>
                                        <a href="/request/downloadFile/'. $attachment->filename. '" >download
                                        </a>
                                    </td>
                                  
                                </tr>';
                }
            }
            else{
                $html .= "<p>There are no attachments for this request</p>";
            }

            return response()->json(['html' => $html]);
           
        }
    }

    public function downloadFile($file)
    {       
        return response()->download(storage_path('app/public/file_upload/' . $file));      
        
    }      
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\DocRequest;
use Session;
use Carbon\Carbon;

class WorkAssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff'))
        {        

            try
            {                
                $requests = DB::table('requestor')
                        ->join('requests', 'requestor.id', '=', 'requests.requestor_id')
                        ->join('documents', 'documents.id', '=', 'requests.document_id')
                        ->select('requestor.*','requestor.id as requestor_id','requests.id as request_id','requests.*', 'documents.*','requests.created_at as request_date')
                        ->where('requests.request_status','verified')  
                        ->get(); 

                $users = DB::table('odr_users')
                        ->whereNotIn('user_type',['admin','requester'])
                        ->get();
            
            }
            catch(\Exception $exception)
            {
                throw new \App\Exceptions\ExceptionLogData($exception);
            }
            //dd($requests);
            return view('workAssignment.index', compact('requests','users'));
        }
    }

    public function store(Request $request )
    {
        //dd($request);
        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff'))
        {
            $validator = Validator::make($request->all(),[
                'assigned_to' => 'required',                
            ],    
            [
                'assigned_to.required' => 'Please select the name of the staff.',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
            }
            else
            {
                try
                {
                  
                    $assign = explode(',',$request['assigned_to']);
                    
                    $query = DB::table('work_assignment')->insert(
                        [
                            //'requestor_id' => 1000,
                            'request_id' => $request['request_id'],
                            'user_id' => \Auth::user()->id,
                            'user_fullname' => \Auth::user()->first_name .' '. \Auth::user()->last_name,
                            'work_type' => 'assign',
                            'assignedTo_id' => $assign[0],
                            'assignedTo_fullname' => trim($assign[1]),
                            'work_status' => 'processing',
                            'created_at' => Carbon::now()
                            
                        ]
                    );

                    if($query)
                    {
                        $updateRequest = DocRequest::find($request['request_id']);
                        $updateRequest->request_status = 'processing';
                        $updateRequest->save();
                    }
                }    
                catch(\Exception $exception)
                {
                    throw new \App\Exceptions\ExceptionLogData($exception);
                }

            }

            if($query)
            {
                Session::flash('success', 'Request has been assigned!');
                return response()->json(['status'=>1, 'msg'=>'The request has been successfully assigned!']);
            }     
            else{
                Session::flash('error', 'Something went wrong uploading data. Please report this to the administrator.');
                return response()->json(['status'=>0, 'msg'=>'Something went wrong.']); 
            } 
        }
    }

    public function markCompleted($id)
    {
        //dd($id);
        if(\Gate::allows('isProcessor'))
        {
            $rowID = explode(',',$id);
            try
            {
                $updateStatus = DocRequest::find($rowID[0]);
                $updateStatus->request_status = 'completed';
                $updateStatus->save();

                if($updateStatus)
                {
                    $updateWorkStatus = DB::table('work_assignment')
                                            ->where('id',$rowID[1])
                                            ->update(
                                                [
                                                    'work_status' => 'completed',
                                                    'updated_at' => Carbon::now()                                           
                                            
                                                ]);
                }
            }  
            catch(\Exception $exception){

                throw new \App\Exceptions\ExceptionLogData($exception);                
            }

            if($updateStatus)
            {
                return redirect('/request')->with('success', 'Request has been marked completed! ');
            }
        }
        
    }

    public function markReleased($id)
    {
        if(\Gate::allows('isWindowStaff'))
        {
            try
            {
                $updateStatus = DocRequest::find($id);
                $updateStatus->request_status = 'released';
                $updateStatus->save();

                /*$updateWorkStatus = DB::table('work_assignment')
                                        ->where('request_id',$id)
                                        ->update(
                                            [
                                            'work_status' => 'released',                                
                                            ]); */
                if($updateStatus)
                {
                    $query = DB::table('work_assignment')->insert(
                    [
                        //'requestor_id' => 1000,
                        'request_id' => $id,
                        'user_id' => \Auth::user()->id,
                        'user_fullname' => \Auth::user()->first_name .' '. \Auth::user()->last_name,
                        'work_type' => 'release',
                        'assignedTo_id' => null,
                        'assignedTo_fullname' => null,
                        'work_status' => 'done',
                        'created_at' => Carbon::now()
                        
                    ]
                    );
                }

            }  
            catch(\Exception $exception){

                throw new \App\Exceptions\ExceptionLogData($exception);                
            }

            if($updateStatus)
            {
                return redirect('/workAssignment/assignments')->with('success', 'Request has been released! ');
            }
        }
        
    }

    public function viewAssignments()
    {
        try
        {
            $assignments = DB::table('requestor')
                        ->join('requests', 'requestor.id', '=', 'requests.requestor_id')
                        ->join('documents', 'documents.id', '=', 'requests.document_id')
                        ->join('work_assignment','requests.id','=','work_assignment.request_id')
                        ->select('requestor.first_name','requestor.last_name','requestor.id as requestor_id',
                                'requests.id as request_id','requests.request_status', 'documents.docName','documents.docParticular',
                                'requests.created_at as request_date','work_assignment.*','work_assignment.id as assignment_id')
                        ->where('work_assignment.work_type','assign')
                        ->where('work_assignment.work_status','processing')
                        ->orderBy('request_date', 'asc')
                        ->paginate(10);  
            //dd($assignments);
                        
        }  
        catch(\Exception $exception){

            throw new \App\Exceptions\ExceptionLogData($exception);                
        }

        if($assignments)
        {
            //dd($staffs);
            return view('workAssignment.viewAssignments', compact('assignments'));
        }
    }

   
}

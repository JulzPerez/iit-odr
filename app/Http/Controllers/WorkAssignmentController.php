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
                    $request_id = $request['request_id'];
                    $assign = explode(',',$request['assigned_to']);
                    $user_fullname = trim($assign[1]);

                    
                    $query = DB::table('work_assignment')->insert([
                        'request_id' => $request_id,
                        'user_id' => $assign[0],
                        'user_fullname' => $user_fullname,
                        'work_status' => 'processing',
                        'assigned_by' => \Auth::user()->first_name .' '.\Auth::user()->last_name,  
                        'created_at' => Carbon::now()              
                    ]);

                    if($query)
                    {
                        $updateRequest = DocRequest::find($request_id);
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
        }
    }

    public function markCompleted($id)
    {
        try
        {
            $updateStatus = DocRequest::find($id);
            $updateStatus->request_status = 'completed';
            $updateStatus->save();

            if($updateStatus)
            {
                $updateWorkStatus = DB::table('work_assignment')
                                        ->where('request_id',$id)
                                        ->update(
                                            [
                                                'work_status' => 'completed',
                                                'completed_date' => Carbon::now()                                           
                                        
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

    public function markReleased($id)
    {
        try
        {
            $updateStatus = DocRequest::find($id);
            $updateStatus->request_status = 'released';
            $updateStatus->release_date = Carbon::now();
            $updateStatus->save();

            $updateWorkStatus = DB::table('work_assignment')
                                    ->where('request_id',$id)
                                    ->update(
                                        [
                                        'work_status' => 'released',                                
                                        ]);

        }  
        catch(\Exception $exception){

            throw new \App\Exceptions\ExceptionLogData($exception);                
        }

        if($updateWorkStatus)
        {
            return redirect('/workAssignment/assignments')->with('success', 'Request has been released! ');
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
                                'requests.created_at as request_date','work_assignment.*')
                        ->where('work_assignment.work_status','processing')
                        ->orWhere('work_assignment.work_status','completed')
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

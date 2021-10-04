<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\DocRequest;

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
        dd($request);
        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff'))
        {
            $this->validate($request, [
                'assigned_to' => 'required',                
            ],    
            [
                'assigned_to.required' => 'Please select the name of the staff.',
            ]);

            try
            {
                $request_id = $request['request_id'];

                DB::table('work_assignment')->insert([
                    'request_id' => $request_id,
                    'user_id' => $request['assigned_to'],
                    'user_fullname' => $request['user_fullname'],
                    'assigned_by' => \Auth::user()->first_name .' '.\Auth::user()->last_name,                
                   
                ]);

                $request = DocRequest::find($request_id);
                $request->request_status = 'processing';
                $request->save();
            }    
            catch(\Exception $exception)
            {
                throw new \App\Exceptions\ExceptionLogData($exception);
            }

            return redirect()->back()->with('success', 'Request successfully assigned!');
        }
    }

    public function markCompleted($id)
    {
        try
        {
            $updateStatus = DocRequest::find($id);
            $updateStatus->request_status = 'completed';
            $updateStatus->save();
        }  
        catch(\Exception $exception){

            throw new \App\Exceptions\LogData($exception);                
        }

        if($updateStatus)
        {
            return redirect('/request')->with('success', 'Request has been marked completed! ');
        }
    }

   
}

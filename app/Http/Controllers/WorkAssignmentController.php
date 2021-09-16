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
            $users = User::where('user_type','=','other staff')
                    ->get();
    
            $requests = DB::table('requestor')
            ->join('requests', 'requests.requestor_id', '=', 'requestor.id')
            ->join('documents', 'documents.id', '=', 'requests.document_id')
            ->select('requestor.*','requests.id as request_id','requests.*', 'documents.*') 
            ->where('requests.payment_status','verified')  
            ->where('requests.request_status','paid')
            ->get(); 
             
            return view('workAssignment.index', compact('requests','users'));
        } 
    }

    public function store(Request $request )
    {
        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff'))
        {
            $this->validate($request, [
                'assigned_to' => 'required',                
            ],
    
            [
                'assigned_to.required' => 'Please select the name of the staff.',
            ]);

            $request_id = $request['request_id'];

            DB::table('work_assignment')->insert([
                'request_id' => $request_id,
                'user_id' => $request['assigned_to'],
                'assigned_by' => \Auth::user()->first_name .' '.\Auth::user()->last_name,                
                'status' => 'processing',
            ]);

            $request = DocRequest::find($request_id);
            $request->request_status = 'assigned';
            $request->save();

            return redirect()->back()->with('success', 'Request successfully assigned!');
        }
    }

    public function viewAssignment()
    {
        if(\Gate::allows('isAdmin') || \Gate::allows('isOtherStaff') || \Gate::allows('isWindowStaff'))
        {
            $user_id = \Auth::user()->id;

            $requests = DB::table('work_assignment')
            ->join('requests', 'work_assignment.request_id', '=', 'requests.id')
            ->join('documents', 'requests.document_id', '=', 'documents.id')   
            ->join('requestor', 'requests.requestor_id', '=', 'requestor.id')       
            ->select('requestor.*','requests.id as request_id','requests.*', 'documents.*') 
            ->where('work_assignment.user_id',$user_id)  
            ->get(); 

            return view('workAssignment.assignedWork', compact('requests'));
        }
    }
}

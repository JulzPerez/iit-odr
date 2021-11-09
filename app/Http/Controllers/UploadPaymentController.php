<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Requestor;
use App\UploadPayment;
use App\DocRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Session;
use Carbon\Carbon;

class UploadPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = \Auth::user()->id;
        $requestor = Requestor::where('user_id', $userid)->first();

        if($requestor != null)
        {
            $requestor_id = $requestor->id;
            $requests = DB::table('requests')
                            ->join('documents','requests.document_id','=','documents.id')
                            ->select('requests.*', 'documents.*', 'requests.id as request_id','requests.created_at as request_date')
                            ->where('requests.requestor_id', '=', $requestor_id)
                            ->where('requests.payment_status','pending')
                            ->where('requests.request_status','assessed') 
                            ->get(); 

            $request_payments = DB::table('payment_proof')
                            ->join('requests','payment_proof.request_id','=','requests.id')
                            ->select('payment_proof.*','requests.*')
                            ->where('requests.requestor_id', '=', $requestor_id)
                            ->get(); 
         
            //dd($requests);      
            return view('payment.index', compact('requests','request_payments'));
        }
        else
        {
            $request = null;
            $request_payments = null;
            return view('payment.index', compact('request','request_payments'));
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
        //dd($request);
        $validator = Validator::make($request->all(),[
            'amount' => 'required|numeric|gt:0',
            'file' => 'required|file|mimes:pdf',
        ],
        [
            'amount.required' => 'Please enter the amount paid.',
            'file.required' => 'Please browse the file to be uploaded.',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else
        {
            if($request->hasfile('file'))
            {
                $file=$request->file('file');

                //$requestor_name = \Auth::user()->last_name;
                $filename = time().'_'.$file->getClientOriginalName();          
                    // Save the file
                $path = $file->storeAs('payments', $filename);
                //dd($path);

                try{ 
                    $query= UploadPayment::create([
                        //'request_id' => 1000,
                        'request_id' => $request['request_id'],
                        'payment_for' => $request['payment_for'],
                        'amount' => $request['amount'],
                        'notes' => $request['notes'],
                        'proof' => $filename
                    ]); 
                }catch(\Exception $exception)
                {
                    throw new \App\Exceptions\ExceptionLogData($exception);
                }

            }    
          /*   else{
                
            }  */   

            if($query)
            {
                try
                {
                    $request = DocRequest::find($request['request_id']);
                    $request->request_status = 'paid';
                    $request->save();
                }
                catch(\Exception $exception)
                {

                    throw new \App\Exceptions\LogData($exception);                
                }            
            }  
            else{
                Session::flash('error', 'Something went wrong uploading data. Please report this to the administrator.');
                return response()->json(['status'=>0, 'msg'=>'Something went wrong.']); 
            }    

            Session::flash('success', 'Proof of payment has been successfully added!');
            return response()->json(['status'=>1, 'msg'=>'The request has been successfully added!']);

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
        try{
            $payment_proof = DB::table('payment_proof')
                //->select('proof')
                ->where('request_id',$id)
                ->first()->proof;
            
        }
        catch(\Exception $exception){

            throw new \App\Exceptions\LogData($exception);                
        }

        if($payment_proof)
        {
            return response()->download(storage_path('app/public/payments/' . $payment_proof));
        }
        else
        {
            return redirect('/request')->with('error','Something went wrong downloading the file!');
        }  

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 
    public function showRequestorPayments($id)
    {
        //$request_id = $id; 
        $payments = DB::table('payment_proof')
            ->join('requests','payment_proof.request_id','=','requests.id')
            ->select('payment_proof.*', 'requests.*','requests.id as request_id')
            ->where('request_id', $id)
            ->orderByDesc('payment_proof.created_at')
            ->get();   
        //dd($payments);
        return view('payment.show', compact('payments','request_id'));
    }

    public function showUploadPaymentForm($id,$docName)
    {
        //dd($payments);  
        return view('payment.index', compact('id','docName'));
    }

    public function verifyPayment($id)
    {
        try
        {
            $updatePayment = DocRequest::find($id);
            $updatePayment->request_status = 'verified';
            $updatePayment->save();

                if($updatePayment)
                {
                    $workStatus = DB::table('work_assignment')->insert(
                        [
                            
                            'request_id' => $id,
                            'user_id' => \Auth::user()->id,
                            'user_fullname' => \Auth::user()->first_name .' '. \Auth::user()->last_name,
                            'work_type' => 'verify',
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

        if($updatePayment)
        {
            return redirect('/request')->with('success', 'Payment has been verified!');
        }
        
        
    }
  
}

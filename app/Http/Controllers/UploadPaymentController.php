<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requestor;
use App\UploadPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            $payments = DB::table('upload_payment')
                            ->where('requestor_id', '=', $requestor_id)
                            ->get(); 

            //dd($requirements);
            $documents = DB::table('requests')
                            ->join('documents','documents.id','=','requests.document_id')
                            ->select('documents.*')
                            ->where('requestor_id', $requestor_id)
                            ->where('request_status', 'assessed')
                            ->where('payment_status', 'pending')
                            ->get();
            //dd($documents);

            return view('payment.index', compact('payments','documents'));
        }
        else
        {
            $payments = null;
            return view('payment.index', compact('payments'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'payment_for' => 'required|max:191',
            'file' => 'required|file|mimes:zip,pdf,jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt',
        ]);

        $userid = \Auth::user()->id;

        $requestor = DB::table('requestor')
                        ->where('user_id', $userid)
                        ->first();
        $requestor_id = $requestor->id;
        $requestor_name = $requestor->first_name.'_'.$requestor->last_name;
        
            $file = $request->file('file');

            if($file != null)
            {
                $filename = $requestor_name.'_'.time().'_'.$file->getClientOriginalName();          
                 // Save the file
                $path = $file->storeAs('payments', $filename);
                //dd($path);
            }           
        
        UploadPayment::create([
            'requestor_id' => $requestor_id,
            'payment_for' => $request['payment_for'],
            'amount' => $request['amount'],
            'notes' => $request['notes'],
            'proof' => $filename
        ]); 

        return redirect('/payment')->with('success', 'Payment uploaded successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->download(storage_path('app/public/authentication/' . $id));
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\Requestor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
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
            $files = DB::table('files')
                            ->where('requestor_id', '=', $requestor_id)
                            ->get(); 

            //dd($requirements);

            return view('upload.index', compact('files'));
        }
        else
        {
            $files = null;
            return view('upload.index', compact('files'));
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
            'doc_name' => 'required',
            'file' => 'required|file|mimes:zip,pdf,jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt',
        ]);

        $userid = \Auth::user()->id;

        $requestor = DB::table('requestor')
                        ->where('user_id', $userid)
                        ->first();
        $requestor_id = $requestor->id;
        
            $file = $request->file('file');

            if($file != null)
            {
                $filename = $requestor_id.'_'.time().'_'.$file->getClientOriginalName();          
                 // Save the file
                $path = $file->storeAs('files', $filename);
                //dd($path);
            }           
        
        File::create([
            'requestor_id' => $requestor_id,
            'name' => $request['doc_name'],
            'filename' => $filename
        ]); 

        return redirect('/files')->with('success', 'File uploaded successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->download(storage_path('app/public/files/' . $id));
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

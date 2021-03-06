<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Document;

class DocumentController extends Controller
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
        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff')){
            
            $docs = DB::table('documents')->latest()->simplePaginate(5);       
            return view('document.index', compact('docs'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff')){
            return view('document.create');
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
        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff')){
            $this->validate($request, [
                'docname' => 'required|string|max:191',
                'docFee' => 'required|numeric'
            ]);

            if ($request->has('requireFileUpload')) 
            {
                $require = 1;
            }
            else $require = 0;
            
            if (! $request->has('manualAssess')) 
            {
                $assess = 0;
            }     
            else $assess = 1;      


            try{
                Document::create([
                    'docName' => $request['docname'],
                    'docParticular' => $request['particular'],
                    'require_file_upload' => $require,
                    'auto_assess' => $assess,
                    'doc_fee' => $request['docFee'],
                ]);
            }
            catch(\Exception $exception)
            {
                throw new \App\Exceptions\ExceptionLogData($exception);
            } 

            
    
            return redirect('/document')->with('success', 'Record added successfully!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff')){
            $doc = Document::find($id);

            return view('document.edit', compact('doc'));
        }
        
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
        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff')){
            $this->validate($request, [
                'docname' => 'required|string|max:191',
                'docFee' => 'required|numeric'
            ]);

            if ($request->has('requireFileUpload')) 
            {
                $require = 1;
            }
            else $require = 0;
            
            if (! $request->has('manualAssess')) 
            {
                $assess = 0;
            }     
            else $assess = 1;
    
            $doc = Document::find($id);
            $doc->docName = $request->get('docname');
            $doc->docParticular = $request->get('particular');
            $doc->doc_fee = $request->get('docFee');
            $doc->auto_assess = $assess;
            $doc->require_file_upload = $require;
            $doc->save();
    
            return redirect('/document')->with('success', 'Record updated successfully!');
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
        if(\Gate::allows('isAdmin') || \Gate::allows('isWindowStaff')){
            $doc = Document::find($id);
            $doc->delete();

            return redirect('/document')->with('success', 'Record deleted successfully!');
        }
        
    }
}

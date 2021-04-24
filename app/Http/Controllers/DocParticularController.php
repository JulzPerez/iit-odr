<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\DocumentParticular;
use Illuminate\Support\Facades\DB;

class DocParticularController extends Controller
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
        $docs = DB::table('documents')
                ->join('document_particulars','documents.id','=','document_particulars.documents_id')
                ->latest('document_particulars.created_at')->simplePaginate(5);   
        
        return view('docParticular.index', compact('docs')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docs = Document::all();

        return view('docParticular.create', compact('docs'));
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
       
        $this->validate($request, [
            /* 'code' => 'required|string|max:191', */
            'docname' => 'required|string|max:191',
        ]);

        DocumentParticular::create([
            'documents_id' => $request->get('docID'),
            /* 'docParticularCode' => $request['code'], */
            'docParticularName' => $request['docname']
        ]);

        return redirect('/docParticular')->with('success', 'Record added successfully!');
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
        $docs = Document::all();
        $particular = DocumentParticular::find($id);

        return view('docParticular.edit', compact('docs','particular'));
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
        $this->validate($request, [
            'docname' => 'required|string|max:191',
            /* 'code' => 'required|string|max:191' */
        ]);

        $doc = DocumentParticular::find($id);
        $doc->documents_id = $request->get('docID');
        $doc->docParticularName = $request->get('docname');
        /* $doc->docParticularCode = $request->get('code'); */
        $doc->save();

        return redirect('/docParticular')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doc = DocumentParticular::find($id);
        $doc->delete();

        return redirect('/docParticular')->with('success', 'Record deleted successfully!');
    }
}

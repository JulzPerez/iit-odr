<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Fee;


class FeesController extends Controller
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
        if(\Gate::allows('isAdmin') || \Gate::allows('isStaff')){
            $fees = DB::table('fees')->latest()->simplePaginate(5);

            return view('fees.index', compact('fees')); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Gate::allows('isAdmin') || \Gate::allows('isStaff')){
            return view('fees.create');
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
        if(\Gate::allows('isAdmin') || \Gate::allows('isStaff')){
            $this->validate($request, [
                'fee_name' => 'required|string|max:191',
                'unit' => 'required|string|max:191',
                'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/|max:191',
    
            ]);
    
            Fee::create([
                'fee_name' => $request['fee_name'],
                'unit' => $request['unit'],
                'amount' => $request['amount'],
            ]);
    
            return redirect('/fees')->with('success', 'Record added successfully!');
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
        if(\Gate::allows('isAdmin') || \Gate::allows('isStaff')){

            $fee = Fee::find($id);

            return view('fees.edit', compact('fee'));
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
        if(\Gate::allows('isAdmin') || \Gate::allows('isStaff')){
            $this->validate($request, [
                'fee_name' => 'required|string|max:191',
                'unit' => 'required|string|max:191',
                'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/|max:191',
    
            ]);
    
            $fee = Fee::find($id);
            $fee->fee_name = $request->get('fee_name');
            $fee->unit = $request->get('unit');
            $fee->amount = $request->get('amount');
            $fee->save();
    
            return redirect('/fees')->with('success', 'Record updated successfully!');
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
        if(\Gate::allows('isAdmin') || \Gate::allows('isStaff')){
            $fee = Fee::find($id);
            $fee->delete();

            return redirect('/fees')->with('success', 'Record deleted successfully!');
        }
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requestor;
use Illuminate\Support\Facades\DB;


class RequesterController extends Controller
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
        //$docID = \Request::get('docID');
        $userid = \Auth::user()->id;
        
        if (DB::table('requestor')->where('user_id', $userid )->doesntExist() ) 
        {
            return view('requestor.create');  
        }
        else 
        {
            $requester = DB::table('requestor')
            ->where('user_id', '=', $userid)
            ->first();

            //dd($requester);

            return view('requestor.index', compact('requester'));
        } 

        //return view('requestor.index');
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
        $userid = \Auth::user()->id;

        Requestor::create([
            'user_id' => $userid,
            'first_name' => $request['first_name'],
            'last_name' => $request['middle_name'],
            'middle_name' => $request['last_name'],
            //'maiden_name' => $request['docname'],
            'id_no' => $request['id_no'],
            'contact_no' => $request['contact_no'],
            'home_address' => $request['home_address'], 
            'mailing_address' => $request['mailing_address'],
            'degree' => $request['degree'],
            'major_option' => $request['option'],
            'academic_distinction' => $request['honor'],
            'date_of_graduation' => $request['graduation_date'],
            'highschool_graduated' => $request['highschool_graduated'], 
            'highschool_address' => $request['highschool_address'],
            'last_sem_attended' => $request['last_sem_attended'],
            'last_sem_AY' => $request['last_AY_attended'], 
            'last_university_attended' => $request['transferee_last_school'],
            'request_purpose' => $request['request_purpose'],
            'sex' => $request['sex'],
            'date_of_birth' => $request['birthdate'], 
            'religion' => $request['religion'], 
            'place_of_birth' => $request['birth_place'], 
            'citizenship' => $request['citizenship'],
            'civil_status' => $request['civil_status'], 
            'spouse' => $request['spouse_name'], 
            'name_of_father' => $request['father_fullname'], 
            'maiden_name_of_mother' => $request['mother_fullmaidenname'], 
            'address_of_parents' => $request['parents_address'], 
            'authorized_person' => $request['authorized_person']
        ]);

        return redirect('/requester')->with('success', 'Record saved successfully!');

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

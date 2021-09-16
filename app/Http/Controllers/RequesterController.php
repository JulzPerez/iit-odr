<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requestor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


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

        $this->validate($request, [
            'first_name' => 'required|string|max:191',
            'middle_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            //'id_no' => 'required|string|max:191',
            'contact_no' => 'required|string|max:191',
            //'home_address' => 'string|max:191',
            'requestor_type' => 'required',
            //'mailing_address' => 'required|string|max:191',
            'degree' => 'required|string|max:191',
            //'option' => 'required|string|max:191',
            //'honor' => 'required|string|max:191',
            //'graduation_date' => 'required',
            'highschool_graduated' => 'required|string|max:191',
            'highschool_address' => 'required|string',
            //'last_sem_attended' => 'required|string|max:191',
            //'last_AY_attended' => 'required|numeric',
            //'transferee_last_school' => 'required|string|max:191',
            //'last_AY_attended' => 'required|string|max:191',
           
            'sex' => 'required|string|max:191',
            'birthdate' => 'required',
            //'religion' => 'required|string|max:191',
            'birth_place' => 'required|string|max:191',
            'citizenship' => 'required|string|max:191',
            'civil_status' => 'required|string|max:191',
            //'spouse_name' => 'required|string|max:191',
            //'father_fullname' => 'required|string|max:191',
            //'mother_fullmaidenname' => 'required|string|max:191',
            //'parents_address' => 'required|string|max:191',
            //'authorized_person' => 'required|string|max:191',
        ], 
            [
            'first_name.required' => 'First Name is required',
            'middle_name.required' => 'Middle Name is required',
            'last_name.required' => 'Last name is required',
            //'id_no.required' => 'required|string|max:191',
            'contact_no.required' => 'Contact No. is required',
            //'home_address.required' => 'required',
            'requestor_type' => 'Please select from list of requestor type.',
            //'mailing_address' => 'required|string|max:191',
            'degree.required' => 'Degree is required',
            //'option.required' => 'required',
            //'honor' => 'required|string|max:191',
            //'graduation_date.required' => 'required',
            'highschool_graduated.required' => 'High School graduated is required',
            'highschool_address.required' => 'High School graduated is required',
            //'last_sem_attended.required' => 'required',
            //'last_AY_attended.required' => 'required',
            //'transferee_last_school' => 'required|string|max:191',
            //'last_AY_attended' => 'required|string|max:191',
           
            'sex.required' => 'Sex field is required',
            'birthdate.required' => 'Please select date of birth',
            //'religion.required' => 'required',
            'birth_place.required' => 'Birthplace field is required',
            'citizenship.required' => 'Citizenship is required',
            'civil_status.required' => 'Civil Status is required',
            //'spouse_name' => 'required|string|max:191',
            //'father_fullname' => 'required|string|max:191',
            //'mother_fullmaidenname' => 'required|string|max:191',
            //'parents_address' => 'required|string|max:191',
          
            ]
        );

        $userid = \Auth::user()->id;

        Requestor::create([
            'user_id' => $userid,
            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            //'maiden_name' => $request['docname'],
            'id_no' => $request['id_no'],
            'requestor_type' => $request['requestor_type'],
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
        $requester = DB::table('requestor')
            ->where('id', '=', $id)
            ->first();

            return view('requestor.index', compact('requester'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requester = Requestor::find($id);

        return view('requestor.edit', compact('requester'));
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
            //validation
            $this->validate($request, [
                'first_name' => 'required|string|max:191',
                'middle_name' => 'required|string|max:191',
                'last_name' => 'required|string|max:191',
                //'id_no' => 'required|string|max:191',
                'contact_no' => 'required|string|max:191',
                'home_address' => 'required|string|max:191',
                'requestor_type' => 'required',
                //'mailing_address' => 'required|string|max:191',
                'degree' => 'required|string|max:191',
                //'option' => 'required|string|max:191',
                //'honor' => 'required|string|max:191',
                //'graduation_date' => 'required',
                'highschool_graduated' => 'required|string|max:191',
                'highschool_address' => 'required|string',
                //'last_sem_attended' => 'required|string|max:191',
                //'last_AY_attended' => 'required|string|max:191',
                //'transferee_last_school' => 'required|string|max:191',
                //'last_AY_attended' => 'required|string|max:191',
                
                'sex' => 'required|string|max:191',
                'birthdate' => 'required',
                //'religion' => 'required|string|max:191',
                'birth_place' => 'required|string|max:191',
                'citizenship' => 'required|string|max:191',
                'civil_status' => 'required|string|max:191',
                //'spouse_name' => 'required|string|max:191',
                //'father_fullname' => 'required|string|max:191',
                //'mother_fullmaidenname' => 'required|string|max:191',
                //'parents_address' => 'required|string|max:191',
                //'authorized_person' => 'required|string|max:191',
            ], 
                [
                'first_name.required' => 'required',
                'middle_name.required' => 'required',
                'last_name.required' => 'required',
                //'id_no.required' => 'required|string|max:191',
                'contact_no.required' => 'required',
                'home_address.required' => 'required',
                'requestor_type' => 'required',
                //'mailing_address' => 'required|string|max:191',
                'degree.required' => 'required',
                //'option.required' => 'required',
                //'honor' => 'required|string|max:191',
                //'graduation_date.required' => 'required',
                'highschool_graduated.required' => 'required',
                'highschool_address.required' => 'required',
                //'last_sem_attended.required' => 'required',
                'last_AY_attended.required' => 'required',
                //'transferee_last_school' => 'required|string|max:191',
                //'last_AY_attended' => 'required|string|max:191',
               
                'sex.required' => 'required',
                'birthdate.required' => 'required',
                //'religion.required' => 'required',
                'birth_place.required' => 'required',
                'citizenship.required' => 'required',
                'civil_status.required' => 'required',
                //'spouse_name' => 'required|string|max:191',
                //'father_fullname' => 'required|string|max:191',
                //'mother_fullmaidenname' => 'required|string|max:191',
                //'parents_address' => 'required|string|max:191',
                //'authorized_person' => 'required|string|max:191',
                ]
            );
    

            $req = Requestor::find($id);

            $req->first_name = $request['first_name'];
            $req->middle_name = $request['middle_name'];
            $req->last_name = $request['last_name'];
            //'maiden_name' = $request['docname'];
            $req->id_no = $request['id_no'];
            $req->requestor_type = $request['requestor_type'];
            $req->contact_no = $request['contact_no'];
            $req->home_address = $request['home_address']; 
            $req->mailing_address = $request['mailing_address'];
            $req->degree = $request['degree'];
            $req->major_option = $request['option'];
            $req->academic_distinction = $request['honor'];
            $req->date_of_graduation = $request['graduation_date'];
            $req->highschool_graduated = $request['highschool_graduated']; 
            $req->highschool_address = $request['highschool_address'];
            $req->last_sem_attended = $request['last_sem_attended'];
            $req->last_sem_AY = $request['last_AY_attended']; 
            $req->last_university_attended = $request['transferee_last_school'];
          
            $req->sex = $request['sex'];
            $req->date_of_birth = $request['birthdate']; 
            $req->religion = $request['religion']; 
            $req->place_of_birth = $request['birth_place']; 
            $req->citizenship = $request['citizenship'];
            $req->civil_status = $request['civil_status']; 
            $req->spouse = $request['spouse_name']; 
            $req->name_of_father = $request['father_fullname']; 
            $req->maiden_name_of_mother = $request['mother_fullmaidenname']; 
            $req->address_of_parents = $request['parents_address']; 
            

            $req->save();

            return redirect('/requester')->with('success', 'Record updated successfully!');
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

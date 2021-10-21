<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Gate::allows('isAdmin') )
        {
            $users = DB::table('odr_users')->whereNotIn('user_type',['admin'])->latest()->simplePaginate(10);

            $all_staff = $users->reject(function ($staff) {
                return $staff->user_type == 'requester';
            });

            return view('users.index', compact('users','all_staff')); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Gate::allows('isAdmin') )
        {
            return view('users.create');
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
        if(\Gate::allows('isAdmin') )
        {
            
            $this->validate($request, [
                'first_name' => 'required|string|max:191',
                'last_name' => 'required|string|max:191',
                'email' => 'required|string|unique:odr_users|max:191',
                'password' => 'required|string|min:8|confirmed',
                'user_type' => 'required|string|max:191',

    
            ]);

            try{
        
                $query = DB::table('odr_users')->insert([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'email' => $request['email'],
                    'user_type' => $request['user_type'],
                    'password' => Hash::make($request['password']),
                    'email_verified_at' => Carbon::now()
                ]);
            }
            catch(\Exception $exception)
            {
                throw new \App\Exceptions\ExceptionLogData($exception);
            } 

            if($query)
            {
                return redirect('/users')->with('success', 'User added successfully!');
            }
            else 
            {
                return redirect('/users')->with('error', 'Something went wrong!');
            }
    
               
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
        if(\Gate::allows('isAdmin') )
        {
            $user = User::find($id);

            return view('users.edit', compact('user'));
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
        if(\Gate::allows('isAdmin') )
        {
            $this->validate($request, [
                'first_name' => 'required|string|max:191',
                'last_name' => 'required|string|max:191',
                'email' => 'required|string|max:191',
                'user_type' => 'required|string|max:191',
    
            ]);
    
            $user = User::find($id);
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->email = $request->get('email');
            $user->user_type = $request->get('user_type');
            
            $user->save();
    
            return redirect('/users')->with('success', 'User updated successfully!');
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
        if(\Gate::allows('isAdmin') )
        {
            $user = User::find($id);
            $user->delete();

            return redirect('/users')->with('success', 'User deleted successfully!');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    private $upload_dir = 'uploads/avatars/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.profile')->with('user', Auth::user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.profile')->with('user', Auth::user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        $user       = Auth::user();
        $password   = false;
        $rules      = [
            'name'  => 'required|max:191',
            'email' => 'required|max:191|unique:users,email,'.$user->id,
        ];

        if(strlen(trim($request->password)) > 0) {
            $rules['password'] = 'required|confirmed|min:6';
        }

        if(strlen(trim($request->password_confirmation)) > 0) {
            $rules['password_confirmation'] = 'min:6';
            $rules['password']              = 'required|confirmed|min:6';
        }

        if(strlen(trim($request->facebook)) > 0)
            $rules['facebook'] = 'url';   

        if(strlen(trim($request->youtube)) > 0)
            $rules['youtube'] = 'url';

        if(strlen(trim($request->google)) > 0) 
            $rules['google'] = 'url';

        if(strlen(trim($request->twitter)) > 0) 
            $rules['twitter'] = 'url';
        
        $this->validate($request, $rules);

        $user->name                 = $request->name;
        $user->email                = $request->email;
        $user->profile->about       = $request->about;
        $user->profile->facebook    = $request->facebook;   
        $user->profile->youtube     = $request->youtube;   
        $user->profile->google      = $request->google;
        $user->profile->twitter     = $request->twitter;

        if(strlen(trim($request->password)) > 0) 
            $user->password = bcrypt($request->password);

        if($user->save()) {
            if($request->hasFile('avatar') && $request->file('avatar') != "") {
                $oldFilename    = $user->profile->avatar;
                $filename       = time().$request->file('avatar')->getClientOriginalName(); // get filename
                $user->profile->avatar = $this->upload_dir.$filename;
                if( strlen(trim($oldFilename)) > 0  && strpos($oldFilename, 'default.png') !== true ) {
                    if( file_exists($oldFilename) ) unlink($oldFilename);
                }
                $request->file('avatar')->move($this->upload_dir, $filename);
            } 

            Session::flash('success', 'Account profile updated!');
        } else {
            Session::flash('error', 'An error occured while updating account profile!');
        }

        $user->profile->save();
        return redirect()->back();

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

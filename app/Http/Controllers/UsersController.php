<?php

namespace App\Http\Controllers;

use Session;
use Auth;
use App\User;
use App\Profile;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('adminCheck');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->save($request);
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
        return $this->save($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user) {
            $user->profile->delete();
            $user->delete();
            Session::flash('success', 'Record successfully deleted!');
        }

        return redirect()->back();
    }

    private function save($request, $id = 0)
    {
        $this->validate($request, [
            'name'  => 'required|max:255',
            'email' => 'required|email'
        ]);

        if($id > 0) {
            $route = redirect()->back();
        } else {
            $route = redirect()->route('users.create');
        }

        $user = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = bcrypt('123456');
        
        if($user->save()) {
            $profile = new Profile;
            $profile->user_id   = $user->id;
            $profile->avatar    = 'uploads/avatars/default.png';
            $profile->save();
            Session::flash('success', 'Record successfully saved!');
        } else {
            Session::flash('error', 'An error occured while saving the data. Please refresh the page!');
        }

        return $route;
    }

    public function set_admin_permission($id)
    {
        $user = User::findOrFail($id);
        $user->admin = 1;
        $user->save();

        Session::flash('success', 'Record successfully saved!');

        return redirect()->back();
    }

    public function remove_admin_permission($id)
    {
        $user = User::findOrFail($id);
        $user->admin = 0;
        $user->save();

        Session::flash('success', 'Record successfully saved!');
        if(Auth::user()->id == $id) 
            return redirect()->route('home');

        return redirect()->back();
    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminHomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.home');
    }

    public function profileEdit()
    {
        $id=Auth::user()->id;
        $admin=Admin::where('id', $id)->firstOrFail();
        return view('admin.profile.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,id,'.$id,
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin=Admin::where('id', $id)->firstOrFail();

        $admin->name=$request['name'];
        $admin->email=$request['email'];
        $admin->password=bcrypt($request['password']);

        $admin->save();


        return redirect()->route('admin.home');

    }
}

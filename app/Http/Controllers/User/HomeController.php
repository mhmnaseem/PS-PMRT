<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Model\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.home');
    }

    public function profileEdit()
    {
        $id=Auth::user()->id;
        $pm=User::where('id', $id)->firstOrFail();
        return view('user.profile.edit', compact('pm'));
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

        $pm=User::where('id', $id)->firstOrFail();

        $pm->name=$request['name'];
        $pm->email=$request['email'];
        $pm->password=bcrypt($request['password']);

        $pm->save();


        return redirect()->route('home');

    }

}

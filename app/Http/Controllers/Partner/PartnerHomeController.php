<?php

namespace App\Http\Controllers\Partner;

use App\Model\Partner\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PartnerHomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:partner');
    }

    public function index()
    {
        return view('partner.home');
    }

    public function profileEdit()
    {
        $id=Auth::user()->id;
        $partner=Partner::where('id', $id)->firstOrFail();
        return view('partner.profile.edit', compact('partner'));
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

        $partner=Partner::where('id', $id)->firstOrFail();

        $partner->name=$request['name'];
        $partner->email=$request['email'];
        $partner->password=bcrypt($request['password']);

        $partner->save();


        return redirect()->route('partner.home');

    }

}

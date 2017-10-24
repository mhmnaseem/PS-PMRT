<?php

namespace App\Http\Controllers\Admin;

use App\Model\Partner\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners=Partner::all();
        return view('admin.partnerAccount.index',compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partnerAccount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:partners',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $partner=new Partner();
        $partner->name=$request['name'];
        $partner->email=$request['email'];
        $partner->admin_id=auth()->user()->id;
        $partner->password=bcrypt($request['password']);

        $partner->save();


        return redirect()->route('partner.index');


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
        $partner=Partner::where('id', $id)->firstOrFail();
        return view('admin.partnerAccount.edit', compact('partner'));
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
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:partners,id,'.$request->get('id'),
            'password' => 'required|string|min:6|confirmed',
        ]);

        $partner=Partner::where('id', $id)->firstOrFail();

        $partner->name=$request['name'];
        $partner->email=$request['email'];
        $partner->password=bcrypt($request['password']);

        $partner->save();


        return redirect()->route('partner.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Partner::where('id', $id)->delete();

        return redirect()->back();
    }
}

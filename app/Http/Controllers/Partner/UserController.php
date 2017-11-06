<?php

namespace App\Http\Controllers\Partner;

use App\Model\Partner\Partner;
use App\Model\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partner=Partner::find(auth()->user()->id);
        $pms=$partner->pms()->get();
        return view('partner.userAccount.index',compact('pms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partner.userAccount.create');
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
            'email' => 'required|string|email|max:255|unique:Users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $pm=new User();
        $pm->name=$request['name'];
        $pm->slug=md5(uniqid());
        $pm->email=$request['email'];
        $pm->partner_id=auth()->user()->id;
        $pm->password=bcrypt($request['password']);

        $pm->save();


        return redirect()->route('pm.index');


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
    public function edit($slug)
    {
        $pm=User::findBySlug($slug)->firstOrFail();
        return view('partner.userAccount.edit', compact('pm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:Users,id,'.$request->get('id'),
            'password' => 'required|string|min:6|confirmed',
        ]);

        $pm=User::findBySlug($slug)->firstOrFail();

        $pm->name=$request['name'];
        $pm->email=$request['email'];
        $pm->password=bcrypt($request['password']);

        $pm->save();


        return redirect()->route('pm.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        User::findBySlug($slug)->delete();

        return redirect()->back();
    }
}

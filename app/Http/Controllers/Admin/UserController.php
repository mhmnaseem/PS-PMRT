<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pms=User::all();
        return view('admin.UserAccount.index',compact('pms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partners=Partner::all();
        return view('admin.UserAccount.create',compact('partners'));
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
            'partner'=>'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:Users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $pm=new User();
        $pm->name=$request['name'];
        $pm->slug=md5(uniqid());
        $pm->email=$request['email'];
        $pm->partner_id=$request['partner'];
        $pm->password=bcrypt($request['password']);

        $pm->save();


        return redirect()->route('pms.index');


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
        $pm=User::where('id', $id)->firstOrFail();
        $partners=Partner::all();
        return view('admin.UserAccount.edit', compact('pm','partners'));
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
            'email' => 'required|string|email|max:255|unique:Users,id,'.$request->get('id'),
            'password' => 'required|string|min:6|confirmed',
        ]);

        $pm=User::where('id', $id)->firstOrFail();

        $pm->name=$request['name'];
        $pm->email=$request['email'];
        $pm->password=bcrypt($request['password']);

        $pm->save();


        return redirect()->route('pms.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->back();
    }
}

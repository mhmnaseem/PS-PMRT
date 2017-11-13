<?php

namespace App\Http\Controllers\User;

use App\Model\Common\Project;
use App\Model\User\NumberPorting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NumberPortingController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        return view('user.numberPorting.create', compact('slug'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$slug)
    {
        $project=Project::findBySlug($slug)->firstOrFail();

        $this->validate($request,[
            'title' => 'required',
            'status' => 'required',
            'date' => 'required|date|after:yesterday'
        ]);

        $numberPorting=new NumberPorting();
        $numberPorting->title=$request->title;
        $numberPorting->status=$request->status;
        $numberPorting->date=$request->date;
        $numberPorting->day=$request->day;
        $numberPorting->hour=$request->hour;
        $numberPorting->comment=$request->comment;
        $numberPorting->project_id=$project->id;
        $numberPorting->save();

        flash('Number Porting Created Successfully..!')->success();


        return redirect('pm/projects/'.$slug.'#number-porting');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug,$id)
    {
        $project=Project::findBySlug($slug)->firstOrFail();
        $numberPorting=$project->projectNumberPorting()->where('id',$id)->firstOrFail();
        return view('user.numberPorting.show', compact('numberPorting','slug'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug,$id)
    {
        $project=Project::findBySlug($slug)->firstOrFail();
        $numberPorting=$project->projectNumberPorting()->where('id',$id)->firstOrFail();
        return view('user.numberPorting.edit', compact('numberPorting','slug'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug,$id)
    {
        $project=Project::findBySlug($slug)->firstOrFail();


        $this->validate($request,[
            'title' => 'required',
            'status' => 'required',
            'date' => 'required|date'


        ]);

        $numberPorting=$project->projectNumberPorting()->where('id',$id)->firstOrFail();
        $numberPorting->title=$request->title;
        $numberPorting->status=$request->status;
        $numberPorting->date=$request->date;
        $numberPorting->day=$request->day;
        $numberPorting->hour=$request->hour;
        $numberPorting->comment=$request->comment;
        $numberPorting->save();

        flash('Number Porting Updated Successfully..!')->success();

        return redirect('pm/projects/'.$slug.'#number-porting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug,$id)
    {
        $project=Project::findBySlug($slug)->firstOrFail();
        $project->projectNumberPorting()->where('id',$id)->firstOrFail()->delete();
        flash('Number Porting Deleted Successfully..!')->success();
        return redirect('pm/projects/'.$slug.'#number-porting');
    }
}

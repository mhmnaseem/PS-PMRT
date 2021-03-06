<?php

namespace App\Http\Controllers\User;

use App\Model\Common\Project;
use App\Model\User\BackEndBuildOut;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackEndBuildOutController extends Controller
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
        return view('user.backEndBuildOut.create', compact('slug'));
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
            'title'=>'required',
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'date|after:start_date|nullable',
            'status' => 'required'

        ]);

        $backEndBuildOut=new BackEndBuildOut();
        $backEndBuildOut->title=$request->title;
        $backEndBuildOut->status=$request->status;
        $backEndBuildOut->start_date=$request->start_date;
        $backEndBuildOut->end_date=$request->end_date;
        $backEndBuildOut->comment=$request->comment;
        $backEndBuildOut->project_id=$project->id;
        $backEndBuildOut->save();

        flash('Back End Build Out Created Successfully..!')->success();


        return redirect('pm/projects/'.$slug.'#back-end-build-out');
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
        $backEndBuildOut=$project->projectBackEndBuildOut()->where('id',$id)->firstOrFail();
        return view('user.backEndBuildOut.show', compact('backEndBuildOut','slug'));
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
        $backEndBuildOut=$project->projectBackEndBuildOut()->where('id',$id)->firstOrFail();
        return view('user.backEndBuildOut.edit', compact('backEndBuildOut','slug'));
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
            'status' => 'required',
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'date|after:start_date|nullable',


        ]);

        $backEndBuildOut=$project->projectBackEndBuildOut()->where('id',$id)->firstOrFail();
        $backEndBuildOut->title=$request->title;
        $backEndBuildOut->status=$request->status;
        $backEndBuildOut->start_date=$request->start_date;
        $backEndBuildOut->end_date=$request->end_date;
        $backEndBuildOut->comment=$request->comment;
        $backEndBuildOut->save();

        flash('Back End Build Out Updated Successfully..!')->success();

        return redirect('pm/projects/'.$slug.'#back-end-build-out');
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
        $project->projectBackEndBuildOut()->where('id',$id)->firstOrFail()->delete();
        flash('Back End Build Out Deleted Successfully..!')->success();
        return redirect('pm/projects/'.$slug.'#back-end-build-out');
    }
}

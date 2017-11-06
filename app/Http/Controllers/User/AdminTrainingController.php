<?php

namespace App\Http\Controllers\User;

use App\Model\Common\Project;
use App\Model\User\AdminTraining;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTrainingController extends Controller
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
        return view('user.adminTraining.create', compact('slug'));
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

        $adminTraining=new AdminTraining();
        $adminTraining->title=$request->title;
        $adminTraining->status=$request->status;
        $adminTraining->date=$request->date;
        $adminTraining->comment=$request->comment;
        $adminTraining->project_id=$project->id;
        $adminTraining->save();

        flash('Admin Training Created Successfully..!')->success();


        return redirect('pm/projects/'.$slug.'#admin-training');
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
        $adminTraining=$project->projectAdminTraining()->where('id',$id)->firstOrFail();
        return view('user.adminTraining.show', compact('adminTraining','slug'));
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
        $adminTraining=$project->projectAdminTraining()->where('id',$id)->firstOrFail();
        return view('user.adminTraining.edit', compact('adminTraining','slug'));
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

        $adminTraining=$project->projectAdminTraining()->where('id',$id)->firstOrFail();
        $adminTraining->title=$request->title;
        $adminTraining->status=$request->status;
        $adminTraining->date=$request->date;
        $adminTraining->comment=$request->comment;
        $adminTraining->save();

        flash('Admin Training Updated Successfully..!')->success();

        return redirect('pm/projects/'.$slug.'#admin-training');
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
        $project->projectAdminTraining()->where('id',$id)->firstOrFail()->delete();
        flash('Admin Training Deleted Successfully..!')->success();
        return redirect('pm/projects/'.$slug.'#admin-training');
    }
}

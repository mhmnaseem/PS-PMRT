<?php

namespace App\Http\Controllers\Partner;

use App\Model\Common\Project;
use App\Model\Partner\Partner;
use App\Model\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectsAssignController extends Controller
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

        $partner=Partner::findorfail(auth()->user()->id);
        $projects=$partner->projects()->latest('id')->get();
        return view('partner.projectsAssign.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $pms=User::all();
//        return view('partner.projectsAssign.create',compact('pms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->validate($request,[
//            'title' => 'required|string|max:200',
//            'description' => 'required',
//            'start_date' => 'required|date|before_or_equal:due_date',
//            'due_date' => 'required|date',
//        ]);
//
//        $project=new Project();
//        $project->title=$request['title'];
//        $project->description=$request['description'];
//        $project->slug=md5(uniqid());
//        $project->status="Assigned";
//        $project->start_date=$request['start_date'];
//        $project->due_date=$request['due_date'];
//        $project->partner_id=$request['partner'];
//        $project->save();
//
//
//        return redirect()->route('admin-project-assign.index');
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
        $pms=User::all();
        $project=Project::findBySlug($slug)->firstorfail();
        return view('partner.projectsAssign.edit',compact('project','pms'));
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
            'title' => 'required|string|max:200',
            'description' => 'required',
            'start_date' => 'required|date|before_or_equal:due_date',
            'due_date' => 'required|date',
        ]);

        $project=Project::findBySlug($slug)->firstorfail();
        $project->title=$request['title'];
        $project->description=$request['description'];
        $project->start_date=$request['start_date'];
        $project->due_date=$request['due_date'];
        $project->partner_id=$request['partner'];
        $project->save();

        return redirect()->route('admin-project-assign.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//       Project::findorfail($id)->delete();
//        return redirect()->back();
    }
}

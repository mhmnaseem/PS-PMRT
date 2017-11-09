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

        $partner = Partner::findorfail(auth()->user()->id);

        //pending projects
        $pendingProjects = $partner->projects()
            ->where('user_id', '=', null)
            ->where('status', '=', 'open')
            ->latest('id')->get();

        //assigned Projects
        $assignedProjects = $partner->projects()
            ->where('status', '!=', 'Completed')
            ->where('user_id', '!=', null)
            ->latest('id')->get();


        // Overdue Projects
        $overdueProjects = $partner->projects()
            ->where('status', '!=', 'Completed')
            ->where('due_date', '<', Carbon::now())
            ->get();


        //Completed Projects
        $completedProjects = $partner->projects()
            ->where('user_id', '!=', null)
            ->where('status', '=', 'Completed')
            ->latest('id')->get();

        //all Projects
        $allProjects = $partner->projects()
            ->latest('id')->get();

        //count results
        $total = [
            'totalPending' => count($pendingProjects),
            'totalAssigned' => count($assignedProjects),
            'totalOverdue' => count($overdueProjects),
            'totalCompleted' => count($completedProjects),
            'allProjects' => count($allProjects)

        ];

        //all partner pms

        $pms = $partner->pms()->get();

        return view('partner.projectsAssign.index', compact('pms', 'pendingProjects', 'assignedProjects','overdueProjects', 'completedProjects', 'allProjects', 'total'));
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
     * @param  \Illuminate\Http\Request $request
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function assign(Request $request)
    {
        $project = Project::findBySlug($request->slug)->firstorfail();
        $project->user_id = $request->pm;
        $project->save();

        return response()->json("true");

    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $pms = User::all();
        $project = Project::findBySlug($slug)->firstorfail();
        return view('partner.projectsAssign.edit', compact('project', 'pms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {


        $this->validate($request, [
            'title' => 'required|string|max:200',
            'description' => 'required',
            'start_date' => 'required|date|before_or_equal:due_date',
            'due_date' => 'required|date',
        ]);

        $project = Project::findBySlug($slug)->firstorfail();
        $project->title = $request['title'];
        $project->description = $request['description'];
        $project->start_date = $request['start_date'];
        $project->due_date = $request['due_date'];
        $project->user_id = $request['project_manager'];
        $project->save();

        return redirect()->route('partner-project-assign.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//       Project::findorfail($id)->delete();
//        return redirect()->back();
    }
}

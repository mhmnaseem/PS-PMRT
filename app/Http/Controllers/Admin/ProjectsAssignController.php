<?php

namespace App\Http\Controllers\Admin;

use App\Model\Common\Project;
use App\Model\Partner\Partner;
use App\Model\User\AdminTraining;
use App\Model\User\BackEndBuildOut;
use App\Model\User\NetworkAssessment;
use App\Model\User\NumberPorting;
use App\Model\User\OnsiteDeliveryGoLive;
use App\Model\User\Pd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProjectsAssignController extends Controller
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
        //$projects=Project::latest('id')->get();


        //pending projects
        $pendingProjects = Project::where('user_id', '=', null)
            ->where('status', '=', 'open')
            ->latest('id')->get();

        //assigned Projects
        $assignedProjects = Project::where('user_id', '!=', null)
            ->where('status', '!=', 'Completed')
            ->latest('id')->get();

        //Overdue Projects
        $overdueProjects = Project::where('status', '!=', 'Completed')
            ->where('due_date', '<', Carbon::now())
            ->get();

        //Completed Projects
        $completedProjects = Project::where('user_id', '!=', null)
            ->where('status', '=', 'Completed')
            ->latest('id')->get();

        //all Projects
        $allProjects = Project::latest('id')->get();

        //count results
        $total = [
            'totalPending' => count($pendingProjects),
            'totalAssigned' => count($assignedProjects),
            'totalOverdue' => count($overdueProjects),
            'totalCompleted' => count($completedProjects),
            'allProjects' => count($allProjects)

        ];


        return view('admin.projectsAssign.index', compact('pendingProjects', 'assignedProjects', 'overdueProjects', 'completedProjects', 'allProjects', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partners = Partner::all();
        return view('admin.projectsAssign.create', compact('partners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:200',
            'description' => 'required',
            'start_date' => 'required|date|after:yesterday',
            'due_date' => 'required|date|after:start_date',
        ]);


        $project = new Project();
        $project->title = $request['title'];
        $project->description = $request['description'];
        $project->slug = md5(uniqid());
        $project->status = "Open";
        $project->start_date = $request['start_date'];
        $project->due_date = $request['due_date'];
        $project->partner_id = $request['partner'];
        $project->save();
        $lastInsertId = $project->id;

        $now = Carbon::now()->toDateTimeString();

        // pd Dump
        Pd::insert([
            ['title' => 'On site visit', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Remote session', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Other', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now]

        ]);

        // NetworkAssessment Dump
        NetworkAssessment::insert([
            ['title' => 'Network assessment Call', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Other', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now]
        ]);

        // Backend Build Dump
        BackEndBuildOut::insert([
            ['title' => 'User Upload', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Call Flows', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Other', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now]

        ]);

        // Number Porting
        NumberPorting::insert([
            ['title' => 'Regular Port', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Project Port', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Other', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now]

        ]);

        // Training
        AdminTraining::insert([
            ['title' => 'Admin Training I', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Admin Training II', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Admin Training III', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'End User Training  I', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'End User Training II', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'End User Training III', 'status' => "Open", 'date' => $now, 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],

        ]);

        // Go Live
        OnsiteDeliveryGoLive::insert([
            ['title' => 'On site Visit', 'location' => '', 'start_date' => $now, 'end_date' => $now, 'status' => "Open", 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Remote Support', 'location' => '', 'start_date' => $now, 'end_date' => $now, 'status' => "Open", 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Other', 'location' => '', 'start_date' => $now, 'end_date' => $now, 'status' => "Open", 'project_id' => $lastInsertId, 'created_at' => $now, 'updated_at' => $now]

        ]);


        return redirect()->route('admin-project-assign.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
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
    public function edit($id)
    {
        $partners = Partner::all();
        $project = Project::findorfail($id);
        return view('admin.projectsAssign.edit', compact('project', 'partners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:200',
            'description' => 'required',
            'start_date' => 'required|date|before_or_equal:due_date',
            'due_date' => 'required|date',
        ]);

        $project = Project::findorfail($id);
        $project->title = $request['title'];
        $project->description = $request['description'];
        $project->start_date = $request['start_date'];
        $project->due_date = $request['due_date'];
        $project->partner_id = $request['partner'];
        $project->save();

        return redirect()->route('admin-project-assign.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::findorfail($id)->delete();
        return redirect()->back();
    }
}

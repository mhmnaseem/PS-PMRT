<?php

namespace App\Http\Controllers\User;

use App\Model\Common\Project;
use App\Model\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
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
    public function index()
    {

        $user = User::findorfail(auth()->user()->id);

        //star projects
        $starProjects = $user->projects()
            ->where('star', '=', 1)
            ->get();


        //pending projects
        $pendingProjects = $user->projects()
            ->where('status', '=', 'Open')
            ->get();

        // Overdue Projects
        $overdueProjects = $user->projects()
            ->where('status', '!=', 'Complete')
            ->where('due_date', '<', Carbon::now())
            ->get();

        //Completed Projects
        $completedProjects = $user->projects()
            ->where('status', '=', 'Complete')
            ->get();

        //All Projects
        $allProjects = $user->projects()->get();


        //count results and put in array
        $total = [
            'totalStars' => count($starProjects),
            'totalPending' => count($pendingProjects),
            'totalOverdue' => count($overdueProjects),
            'totalCompleted' => count($completedProjects),
            'allProjects' => count($allProjects)
        ];


        return view('user.projects.index', compact('starProjects', 'pendingProjects', 'overdueProjects', 'completedProjects', 'allProjects', 'total'));
    }


    public function star(Request $request)
    {

        $project = Project::findBySlug($request->slug)->firstOrFail();
        $project->star = $request->value;
        $project->save();

        return response()->json(
            [
                'success' => true,
            ], 200
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::findBySlug($slug)->firstOrFail();
        return view('user.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $project = Project::findBySlug($slug)->firstOrFail();
        return view('user.projects.edit', compact('project'));
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
            'status' => 'required'

        ]);

        $project = Project::findBySlug($slug)->firstOrFail();

        if ($request->status == "Complete") {

            if (getProgress($slug) == 100) {
                $project->status = "Complete";
                if ($project->complete_date == null) {
                    $project->complete_date = Carbon::now();
                }

                $project->save();

                flash('Project Complete...!')->info();
            } else {
                flash('Progress Should be 100% to Complete the Project')->warning();
            }


        } else {

            $project->status = $request->status;
            $project->save();

            flash('Project Updated...!')->success();
        }


        return redirect('pm/projects/' . $slug . '#home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

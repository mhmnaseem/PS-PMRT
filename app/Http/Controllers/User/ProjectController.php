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

        //pending projects
        $pendingProjects = $user->projects()
            ->where('status', '=', 'Open')
            ->latest('id')->get();

        // Overdue Projects
        $overdueProjects = $user->projects()
            ->where('status', '!=', 'Completed')
            ->where('due_date', '<', Carbon::now())
            ->latest('id')->get();

        //Completed Projects
        $completedProjects = $user->projects()
            ->where('status', '=', 'Completed')
            ->latest('id')->get();

        //All Projects
        $allProjects = $user->projects()->get();


        //assigned Projects
        $assignedProjects = $user->projects()
            ->where('status', '!=', 'Completed')
            ->latest('id')->get();


        //count results and put in array
        $total = [
            'totalAssigned' => count($assignedProjects),
            'totalPending' => count($pendingProjects),
            'totalOverdue' => count($overdueProjects),
            'totalCompleted' => count($completedProjects),
            'allProjects' => count($allProjects)
        ];


        return view('user.projects.index', compact('pendingProjects', 'overdueProjects', 'completedProjects', 'allProjects','assignedProjects', 'total'));
    }


    public function snapShot(Request $request)
    {

        $project = Project::findBySlug($request->slug)->firstOrFail();



        $html ='<table id="snapshot" class="table table-bordered table-striped">';
        $html .='<thead>';
        $html .='<tr>';
        $html .='<th class="no-sort">Project Phase</th>';
        $html .='<th class="no-sort">Task Name</th>';
        $html .='<th class="no-sort">Task Status</th>';
        $html .='<th class="no-sort">Task Progress</th>';
        $html .='</tr>';
        $html .='</thead>';
        $html .='<tbody>';
        // p&d
        if ($project->ProjectPd->isNotEmpty()) {

            foreach ($project->projectPd as $pd){
                $html .= '<tr>';
                $html .= '<td>Planning and Design</td>';
                $html .= '<td>';
                $html .= $pd->title;
                $html .= '</td>';
                $html .= '<td>';
                $html .= statusColor($pd->status);
                $html .= '</td>';
                $html .= '<td>';
                $html .= calculateSubTaskProgress($project->ProjectPd,$pd->id);
                $html .= '</td>';
                $html .='</tr>';
            }


        }
        // network Assessment
        if ($project->projectNetworkAssessment->isNotEmpty()) {

            foreach ($project->projectNetworkAssessment as $network){
                $html .= '<tr>';
                $html .= '<td>Network Assessment</td>';
                $html .= '<td>';
                $html .= $network->title;
                $html .= '</td>';
                $html .= '<td>';
                $html .= statusColor($network->status);
                $html .= '</td>';
                $html .= '<td>';
                $html .= calculateSubTaskProgress($project->projectNetworkAssessment,$network->id);
                $html .= '</td>';
                $html .='</tr>';
            }


        }

        //Back End Build Out
        if ($project->projectBackEndBuildOut->isNotEmpty()) {

            foreach ($project->projectBackEndBuildOut as $backend){
                $html .= '<tr>';
                $html .= '<td>Back End Build Out</td>';
                $html .= '<td>';
                $html .= $backend->title;
                $html .= '</td>';
                $html .= '<td>';
                $html .= statusColor($backend->status);
                $html .= '</td>';
                $html .= '<td>';
                $html .= calculateSubTaskProgress($project->projectBackEndBuildOut,$backend->id);
                $html .= '</td>';
                $html .='</tr>';
            }


        }

        //Number Porting
        if ($project->projectNumberPorting->isNotEmpty()) {

            foreach ($project->projectNumberPorting as $numberPort){
                $html .= '<tr>';
                $html .= '<td>Number Porting</td>';
                $html .= '<td>';
                $html .= $numberPort->title;
                $html .= '</td>';
                $html .= '<td>';
                $html .= statusColor($numberPort->status);
                $html .= '</td>';
                $html .= '<td>';
                $html .= calculateSubTaskProgress($project->projectNumberPorting,$numberPort->id);
                $html .= '</td>';
                $html .='</tr>';
            }


        }

        // Training
        if ($project->projectAdminTraining->isNotEmpty()) {

            foreach ($project->projectAdminTraining as $admin){
                $html .= '<tr>';
                $html .= '<td>Training</td>';
                $html .= '<td>';
                $html .= $admin->title;
                $html .= '</td>';
                $html .= '<td>';
                $html .= statusColor($admin->status);
                $html .= '</td>';
                $html .= '<td>';
                $html .= calculateSubTaskProgress($project->projectAdminTraining,$admin->id);
                $html .= '</td>';
                $html .='</tr>';
            }


        }
        //Go Live
        if ($project->projectOnsiteDeliveryGoLive->isNotEmpty()) {

            foreach ($project->projectOnsiteDeliveryGoLive as $onSiteDelivery){
                $html .= '<tr>';
                $html .= '<td>Go Live</td>';
                $html .= '<td>';
                $html .= $onSiteDelivery->title;
                $html .= '</td>';
                $html .= '<td>';
                $html .= statusColor($onSiteDelivery->status);
                $html .= '</td>';
                $html .= '<td>';
                $html .= calculateSubTaskProgress($project->projectOnsiteDeliveryGoLive,$onSiteDelivery->id);
                $html .= '</td>';
                $html .='</tr>';
            }


        }




        $html .='</tbody>';
        $html .='</table>';
        $html .='<h5><strong>Export Snap Shot</strong></h5>';
        $html .='<div id="buttons"></div>';



        return response()->json(
            [
                'success' => true,
                'html'=>$html
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

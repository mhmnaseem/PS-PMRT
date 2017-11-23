<?php

namespace App\Http\Controllers\Share;

use App\Model\Common\Project;
use App\Model\User\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShareController extends Controller
{

    public function expensePdfExport($slug)
    {
        $project = Project::findBySlug($slug)->firstOrFail();
        $data = [
            'name' => $project->pm->name,
            'date' => Carbon::now(),
            'reportTitle' => $project->title,
            'project' => $project,

        ];
        $pdf = PDF::loadView('pdf.expensePdf', $data);
        return $pdf->download('expensesExport.pdf');
    }

    public function overviewExport($slug)
    {
        $project = Project::findBySlug($slug)->firstOrFail();
        $data = [
            'name' => $project->pm->name,
            'date' => Carbon::now(),
            'reportTitle' => $project->title,
            'project' => $project,

        ];
        $pdf = PDF::loadView('pdf.projectOverviewPdf', $data);
        return $pdf->download('projectOverviewExport.pdf');
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
        $html .='<div id="buttons"> <a class="btn btn-default" href="'.route('overview.export',$project->slug).'">PDF</a></div>';



        return response()->json(
            [
                'success' => true,
                'html'=>$html
            ], 200
        );


    }


}

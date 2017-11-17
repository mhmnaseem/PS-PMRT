<?php

namespace App\Http\Controllers\User;

use App\Model\Common\Project;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class CronJobsController extends Controller
{
    public function completeProject()
    {
        $projects = Project::all();

        foreach ($projects as $project) {

            if ($project->status != "Complete" & $project->complete_date == null) {

               if (getProgress($project->slug) == 100) {
                   $completeProject = Project::findBySlug($project->slug)->firstOrFail();
                   $completeProject->status = "Complete";
                   $completeProject->complete_date = Carbon::now();
                   $completeProject->save();
                }
            }
        }

        echo "Cron Job Success..!";

    }



}

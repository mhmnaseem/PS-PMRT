<?php


use App\Model\Common\Project;
use Carbon\Carbon;


function calculateProgress($slug)
{

    $total = getProgress($slug);

    if ($total <= 20) {
        $labelColor = 'danger';
    } elseif ($total > 20 && $total <= 33) {
        $labelColor = 'warning';
    } elseif ($total > 34 && $total <= 66) {
        $labelColor = 'info';
    } elseif ($total > 67 && $total <= 83) {
        $labelColor = 'primary';
    } else {
        $labelColor = 'success';
    }

    return $total . '% <div class="progress progress-xs" style="margin-top:0px;">
						  <div class="progress-bar progress-bar-striped active progress-bar-' . $labelColor . '" role="progressbar" aria-valuenow="' . $total . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $total . '%">
						  </div>
						</div>';

}


function getProgress($slug)
{
    $project = Project::findBySlug($slug)->firstOrFail();

    $pd = $project->projectPd()->count();
    if ($pd >= 1) {

        $pdCollects = $project->projectPd()->get();
        $pdValue = getProgressByCollection($pdCollects);

    } else {
        $pdValue = 0;
    }
    $networkAssessment = $project->projectNetworkAssessment()->count();
    if ($networkAssessment >= 1) {

        $networkAssessmentCollects = $project->projectNetworkAssessment()->get();
        $networkAssessmentValue = getProgressByCollection($networkAssessmentCollects);

    } else {
        $networkAssessmentValue = 0;
    }
    $adminTraining = $project->projectAdminTraining()->count();
    if ($adminTraining >= 1) {

        $adminTrainingCollects = $project->projectAdminTraining()->get();
        $adminTrainingValue = getProgressByCollection($adminTrainingCollects);

    } else {
        $adminTrainingValue = 0;
    }
    $backEndBuildOut = $project->projectBackEndBuildOut()->count();
    $backEndBuildOutCollects = $project->projectBackEndBuildOut()->get();
    if ($backEndBuildOut >= 1) {

        $backEndBuildOutValue=getProgressByCollection($backEndBuildOutCollects);

    } else {
        $backEndBuildOutValue = 0;
    }
    $numberPorting = $project->projectNumberPorting()->count();
    if ($numberPorting >= 1) {


        $numberPortingCollects = $project->projectNumberPorting()->get();
        $numberPortingValue = getProgressByCollection($numberPortingCollects);


    } else {
        $numberPortingValue = 0;
    }
    $onsiteDeliveryGoLive = $project->projectOnsiteDeliveryGoLive()->count();
    if ($onsiteDeliveryGoLive >= 1) {

        $onsiteDeliveryGoLiveCollects = $project->projectNumberPorting()->get();
        $onsiteDeliveryGoLiveValue = getProgressByCollection($onsiteDeliveryGoLiveCollects);


    } else {
        $onsiteDeliveryGoLiveValue = 0;
    }

    $totalValue = $pdValue + $networkAssessmentValue + $adminTrainingValue + $backEndBuildOutValue + $numberPortingValue + $onsiteDeliveryGoLiveValue;

    $total = round($totalValue);


    return (int)$total;
}

function getProgressByCollection($collection)
{

    $progressArray = [];
    $progressCollects = $collection;
    $childCount = $progressCollects->count();
    foreach ($progressCollects as $progressCollect) {
        if ($progressCollect->status == "Completed") {
            $progressArray[$progressCollect->id] = ((1 * 100 / 6) / $childCount);
        }elseif ($progressCollect->status == "Onhold") {
            $progressArray[$progressCollect->id] = ((1 * 100 / 6) / $childCount / 4);
        }
        elseif ($progressCollect->status == "In Progress") {
            $progressArray[$progressCollect->id] = ((1 * 100 / 6) / $childCount / 4);
        }
        elseif ($progressCollect->status == "Scheduled") {
            $progressArray[$progressCollect->id] = ((1 * 100 / 6) / $childCount / 4);
        }
        elseif ($progressCollect->status == "Submitted") {
            $progressArray[$progressCollect->id] = ((1 * 100 / 6) / $childCount / 4);
        }
        elseif ($progressCollect->status == "Approved") {
            $progressArray[$progressCollect->id] = ((1 * 100 / 6) / $childCount / 4);
        }
        else {
            $progressArray[$progressCollect->id] = 0;
        }

    }


    return (int)array_sum($progressArray);
}


function calculateSubTaskProgress($collections, $id)
{

    $total = getProgressBySubTask($collections, $id);

    if ($total <= 20) {
        $labelColor = 'danger';
    } elseif ($total > 20 && $total <= 33) {
        $labelColor = 'warning';
    } elseif ($total > 34 && $total <= 66) {
        $labelColor = 'info';
    } elseif ($total > 67 && $total <= 83) {
        $labelColor = 'primary';
    } else {
        $labelColor = 'success';
    }

    return $total . '% <div class="progress progress-xs" style="margin-top:0px;">
						  <div class="progress-bar progress-bar-striped active progress-bar-' . $labelColor . '" role="progressbar" aria-valuenow="' . $total . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $total . '%">
						  </div>
						</div>';

}


function getProgressBySubTask($collection, $id)
{

    $progress = 0;
    foreach ($collection as $record) {

        if ($record->id == $id) {

            if ($record->status == "Completed") {
                $progress = 100;
            } elseif ($record->status == "Onhold") {
                $progress = (1 * 100 / 4);
            } elseif ($record->status == "In Progress") {
                $progress = (1 * 100 / 4);
            } elseif ($record->status == "Scheduled") {
                $progress = (1 * 100 / 4);
            } elseif ($record->status == "Submitted") {
                $progress = (1 * 100 / 4);
            } elseif ($record->status == "Approved") {
                $progress = (1 * 100 / 4);
            } else  {
                $progress = 0;
            }
        }
    }


    return (int)$progress;
}


//function calculateSubTaskProgressBackEnd($collection, $id)
//{
//
//    $total = getProgressBySubTaskBackEnd($collection, $id);
//
//    if ($total <= 20) {
//        $labelColor = 'danger';
//    } elseif ($total > 20 && $total <= 33) {
//        $labelColor = 'warning';
//    } elseif ($total > 34 && $total <= 66) {
//        $labelColor = 'info';
//    } elseif ($total > 67 && $total <= 83) {
//        $labelColor = 'primary';
//    } else {
//        $labelColor = 'success';
//    }
//
//    return $total . '% <div class="progress progress-xs" style="margin-top:0px;">
//						  <div class="progress-bar progress-bar-striped active progress-bar-' . $labelColor . '" role="progressbar" aria-valuenow="' . $total . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $total . '%">
//						  </div>
//						</div>';
//
//}
//
//function getProgressBySubTaskBackEnd($collection, $id)
//{
//    $progress = 0;
//
//    $progressCollects = $collection;
//    foreach ($progressCollects as $progressCollect) {
//
//        if ($progressCollect->id == $id) {
//            if ($progressCollect->user_upload == "Completed" & $progressCollect->call_flows == "Completed") {
//                $progress = 100;
//            } elseif ($progressCollect->user_upload != "Completed" || $progressCollect->call_flows != "Completed") {
//                $progress = (1 * 100 / 4);
//            }
//        }
//    }
//
//    return (int)$progress;
//}

function statusColor($status)
{

    switch ($status) {

        case "Open":
            return '<span class="label label-default">' . $status . '</span>';
            break;
        case "Onhold":
            return '<span class="label label-warning">' . $status . '</span>';
            break;
        case "Submitted":
            return '<span class="label label-fuchsia">' . $status . '</span>';
            break;
        case "Inprogress":
            return '<span class="label label-primary">' . $status . '</span>';
            break;
        case "Scheduled":
            return '<span class="label label-purple">' . $status . '</span>';
            break;
        case "Completed":
            return '<span class="label label-success">' . $status . '</span>';
            break;
        case "Approved":
            return '<span class="label label-blue">' . $status . '</span>';
            break;
        default:
            return '<span class="label label-info">' . $status . '</span>';
    }

}

function dueDays($date)
{

    $now = Carbon::now();
    $result = $date->diffInDays($now);

    return '<span class="label label-danger">Overdue by ' . $result . ' Days</span>';


}

function selectCreate($name)
{
    $key = "\'.$name.\'";

    $html = '<select id="' . $name . '" class="form-control" name="' . $name . '" required>';
    $html .= '<option value="N/A" ' . ((old($key) == 'N/A') ? "selected" : "") . '>N/A</option>';
    $html .= '<option value="Onhold" ' . ((old($key) == "Onhold") ? " selected" : "") . '>Onhold</option>';
    $html .= '<option value="In Progress" ' . ((old($key) == "In Progress") ? " selected" : "") . '>In Progress</option>';
    $html .= '<option value="Scheduled" ' . ((old($key) == "Scheduled") ? " selected" : "") . '>Scheduled</option>';
    $html .= '<option value="Submitted" ' . ((old($key) == "Submitted") ? " selected" : "") . '>Submitted</option>';
    $html .= '<option value="Approved" ' . ((old($key) == "Approved") ? " selected" : "") . '>Approved</option>';
    $html .= '<option value="Completed" ' . ((old($key) == "Completed") ? " selected" : "") . '>Completed</option>';

    $html .= '</select>';


    return $html;
}

function selectUpdate($name, $value)
{
    $key = "\'.$name.\'";

    $html = '<select id="' . $name . '" class="form-control" name="' . $name . '" required>';
    $html .= '<option value="N/A" ' . ((old($key, $value) == 'N/A') ? "selected" : "") . '>N/A</option>';
    $html .= '<option value="Onhold" ' . ((old($key, $value) == "Onhold") ? " selected" : "") . '>Onhold</option>';
    $html .= '<option value="In Progress" ' . ((old($key, $value) == "In Progress") ? " selected" : "") . '>In Progress</option>';
    $html .= '<option value="Scheduled" ' . ((old($key, $value) == "Scheduled") ? " selected" : "") . '>Scheduled</option>';
    $html .= '<option value="Submitted" ' . ((old($key, $value) == "Submitted") ? " selected" : "") . '>Submitted</option>';
    $html .= '<option value="Approved" ' . ((old($key, $value) == "Approved") ? " selected" : "") . '>Approved</option>';
    $html .= '<option value="Completed" ' . ((old($key, $value) == "Completed") ? " selected" : "") . '>Completed</option>';

    $html .= '</select>';


    return $html;

}

function timeSpent($startDate,$endDate){


    return sprintf('%s %s %s',
        formatDateInterval('%d', 'day', $startDate,$endDate),
        formatDateInterval('%h', 'hour', $startDate,$endDate),
        formatDateInterval('%i', 'minute', $startDate,$endDate)
    );


}

function formatDateInterval($format, $interval, $startDate,$endDate)
{
    $count = $startDate->diff($endDate)->format($format);

    return sprintf('%s %s', $count, str_plural($interval, $count));
}



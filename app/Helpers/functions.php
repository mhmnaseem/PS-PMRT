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

        $pdCollects=$project->projectPd()->get();
        $pdValue = getProgressByCollection($pdCollects);

    } else {
        $pdValue = 0;
    }
    $networkAssessment = $project->projectNetworkAssessment()->count();
    if ($networkAssessment >= 1) {

        $networkAssessmentCollects=$project->projectNetworkAssessment()->get();
        $networkAssessmentValue = getProgressByCollection($networkAssessmentCollects);

    } else {
        $networkAssessmentValue = 0;
    }
    $adminTraining = $project->projectAdminTraining()->count();
    if ($adminTraining >= 1) {

       $adminTrainingCollects=$project->projectAdminTraining()->get();
       $adminTrainingValue = getProgressByCollection($adminTrainingCollects);

    } else {
        $adminTrainingValue = 0;
    }
    $backEndBuildOut = $project->projectBackEndBuildOut()->count();
    if ($backEndBuildOut >= 1) {

        $progressArray = [];
        $progressCollects = $project->projectBackEndBuildOut()->get();
        foreach ($progressCollects as $progressCollect) {
            if ($progressCollect->user_upload == "Complete" & $progressCollect->call_flows == "Complete") {
                $progressArray[$progressCollect->id] = ((1 * 100 / 6) / $backEndBuildOut);
            }

        }

        $backEndBuildOutValue = array_sum($progressArray);

    } else {
        $backEndBuildOutValue = 0;
    }
    $numberPorting = $project->projectNumberPorting()->count();
    if ($numberPorting >= 1) {


        $numberPortingCollects=$project->projectNumberPorting()->get();
        $numberPortingValue = getProgressByCollection($numberPortingCollects);


    } else {
        $numberPortingValue = 0;
    }
    $onsiteDeliveryGoLive = $project->projectOnsiteDeliveryGoLive()->count();
    if ($onsiteDeliveryGoLive >= 1) {

        $onsiteDeliveryGoLiveCollects=$project->projectNumberPorting()->get();
        $onsiteDeliveryGoLiveValue = getProgressByCollection($onsiteDeliveryGoLiveCollects);


    } else {
        $onsiteDeliveryGoLiveValue = 0;
    }

    $totalValue = $pdValue + $networkAssessmentValue + $adminTrainingValue + $backEndBuildOutValue + $numberPortingValue + $onsiteDeliveryGoLiveValue;

    $total = round($totalValue);
    $intTotal=(int) $total;

    return $intTotal;
}

function getProgressByCollection($collection)
{

    $progressArray = [];
    $progressCollects = $collection;
    $childCount=$progressCollects->count();
    foreach ($progressCollects as $progressCollect) {
        if ($progressCollect->status == "Complete") {
            $progressArray[$progressCollect->id] = ((1 * 100 / 6) / $childCount);
        }

    }
    return array_sum($progressArray);
}

function statusColor($status)
{

    switch ($status) {

        case "Open":
            return '<span class="label label-default">' . $status . '</span>';
            break;
        case "Submitted":
            return '<span class="label label-primary">' . $status . '</span>';
            break;
        case "Inprogress":
            return '<span class="label label-warning">' . $status . '</span>';
            break;
        case "Closed":
            return '<span class="label label-danger">' . $status . '</span>';
            break;
        case "Complete":
            return '<span class="label label-success">' . $status . '</span>';
            break;
        case "Pending":
            return '<span class="label label-warning">' . $status . '</span>';
            break;
        case "Approved":
            return '<span class="label label-success">' . $status . '</span>';
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
    $html .= '<option value="Pending" ' . ((old($key) == "Pending") ? " selected" : "") . '>Pending</option>';
    $html .= '<option value="Submitted" ' . ((old($key) == "Submitted") ? " selected" : "") . '>Submitted</option>';
    $html .= '<option value="Inprogress" ' . ((old($key) == "Inprogress") ? " selected" : "") . '>Inprogress</option>';
    $html .= '<option value="Complete" ' . ((old($key) == "Complete") ? " selected" : "") . '>Complete</option>';
    $html .= '<option value="Approved" ' . ((old($key) == "Approved") ? " selected" : "") . '>Approved</option>';
    $html .= '<option value="Closed" ' . ((old($key) == "Closed") ? " selected" : "") . '>Closed</option>';

    $html .= '</select>';


    return $html;
}

function selectUpdate($name, $value)
{
    $key = "\'.$name.\'";

    $html = '<select id="' . $name . '" class="form-control" name="' . $name . '" required>';
    $html .= '<option value="N/A" ' . ((old($key, $value) == 'N/A') ? "selected" : "") . '>N/A</option>';
    $html .= '<option value="Onhold" ' . ((old($key, $value) == "Onhold") ? " selected" : "") . '>Onhold</option>';
    $html .= '<option value="Pending" ' . ((old($key, $value) == "Pending") ? " selected" : "") . '>Pending</option>';
    $html .= '<option value="Submitted" ' . ((old($key, $value) == "Submitted") ? " selected" : "") . '>Submitted</option>';
    $html .= '<option value="Inprogress" ' . ((old($key, $value) == "Inprogress") ? " selected" : "") . '>Inprogress</option>';
    $html .= '<option value="Complete" ' . ((old($key, $value) == "Complete") ? " selected" : "") . '>Complete</option>';
    $html .= '<option value="Approved" ' . ((old($key, $value) == "Approved") ? " selected" : "") . '>Approved</option>';
    $html .= '<option value="Closed" ' . ((old($key, $value) == "Closed") ? " selected" : "") . '>Closed</option>';

    $html .= '</select>';


    return $html;

}

function portCreate($name)
{
    $key = "\'.$name.\'";

    $html = '<select id="' . $name . '" class="form-control" name="' . $name . '" required>';
    $html .= '<option value="N/A" ' . ((old($key) == 'N/A') ? "selected" : "") . '>N/A</option>';
    $html .= '<option value="Regular" ' . ((old($key) == "Regular") ? " selected" : "") . '>Regular</option>';
    $html .= '<option value="Project" ' . ((old($key) == "Project") ? " selected" : "") . '>Project</option>';

    $html .= '</select>';


    return $html;
}

function portUpdate($name, $value)
{
    $key = $name;

    $html = '<select id="' . $name . '" class="form-control" name="' . $name . '" required>';
    $html .= '<option value="N/A" ' . ((old($key, $value) == 'N/A') ? "selected" : "") . '>N/A</option>';
    $html .= '<option value="Regular" ' . ((old($key, $value) == "Regular") ? " selected" : "") . '>Regular</option>';
    $html .= '<option value="Project" ' . ((old($key, $value) == "Project") ? " selected" : "") . '>Project</option>';

    $html .= '</select>';


    return $html;
}



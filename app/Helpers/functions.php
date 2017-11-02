<?php


use App\Model\Common\Project;
use Carbon\Carbon;


function calculateProgress($slug)
{

    $project = Project::findBySlug($slug)->firstOrFail();

    $pd = $project->projectPd()->count();
    if ($pd >= 1) {
        $pdValue = 1 * 100 / 6;
    } else {
        $pdValue = 0;
    }
    $networkAssessment = $project->projectNetworkAssessment()->count();
    if ($networkAssessment >= 1) {
        $networkAssessmentValue = 1 * 100 / 6;
    } else {
        $networkAssessmentValue = 0;
    }
    $adminTraining = $project->projectAdminTraining()->count();
    if ($adminTraining >= 1) {
        $adminTrainingValue = 1 * 100 / 6;
    } else {
        $adminTrainingValue = 0;
    }
    $backEndBuildOut = $project->projectBackEndBuildOut()->count();
    if ($backEndBuildOut >= 1) {
        $backEndBuildOutValue = 1 * 100 / 6;
    } else {
        $backEndBuildOutValue = 0;
    }
    $numberPorting = $project->projectNumberPorting()->count();
    if ($numberPorting >= 1) {
        $numberPortingValue = 1 * 100 / 6;
    } else {
        $numberPortingValue = 0;
    }
    $onsiteDeliveryGoLive = $project->projectOnsiteDeliveryGoLive()->count();
    if ($onsiteDeliveryGoLive >= 1) {
        $onsiteDeliveryGoLiveValue = 1 * 100 / 6;
    } else {
        $onsiteDeliveryGoLiveValue = 0;
    }

    $totalValue = $pdValue + $networkAssessmentValue + $adminTrainingValue + $backEndBuildOutValue + $numberPortingValue + $onsiteDeliveryGoLiveValue;

    $total=round($totalValue);

    if ($total <= 20) {
        $labelColor = 'danger';
    } elseif ($total > 20 && $total <= 50) {
        $labelColor = 'warning';
    } elseif ($total > 50 && $total <= 75) {
        $labelColor = 'info';
    } else {
        $labelColor = 'success';
    }


    return $total . '% <div class="progress progress-xs" style="margin-top:0px;">
						  <div class="progress-bar progress-bar-' . $labelColor . '" role="progressbar" aria-valuenow="' . $total . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $total . '%">
						  </div>
						</div>';

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
    $html .= '<option value="Submitted" ' . ((old($key) == "Closed") ? " selected" : "") . '>Submitted</option>';
    $html .= '<option value="Inprogress" ' . ((old($key) == "Inprogress") ? " selected" : "") . '>Inprogress</option>';
    $html .= '<option value="Complete" ' . ((old($key) == "Complete") ? " selected" : "") . '>Complete</option>';
    $html .= '<option value="Approved" ' . ((old($key) == "Closed") ? " selected" : "") . '>Approved</option>';
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
    $html .= '<option value="Submitted" ' . ((old($key, $value) == "Closed") ? " selected" : "") . '>Submitted</option>';
    $html .= '<option value="Inprogress" ' . ((old($key, $value) == "Inprogress") ? " selected" : "") . '>Inprogress</option>';
    $html .= '<option value="Complete" ' . ((old($key, $value) == "Complete") ? " selected" : "") . '>Complete</option>';
    $html .= '<option value="Approved" ' . ((old($key, $value) == "Closed") ? " selected" : "") . '>Approved</option>';
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



<?php


use Carbon\Carbon;

function progressColor($progress)
{
    if ($progress <= 20)
        return 'danger';
    elseif ($progress > 20 && $progress <= 50)
        return 'warning';
    elseif ($progress > 50 && $progress <= 75)
        return 'info';
    else
        return 'success';
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

function portUpdate($name,$value)
{
    $key = $name;

    $html = '<select id="' . $name . '" class="form-control" name="' . $name . '" required>';
    $html .= '<option value="N/A" ' . ((old($key,$value) == 'N/A') ? "selected" : "") . '>N/A</option>';
    $html .= '<option value="Regular" ' . ((old($key,$value) == "Regular") ? " selected" : "") . '>Regular</option>';
    $html .= '<option value="Project" ' . ((old($key,$value) == "Project") ? " selected" : "") . '>Project</option>';

    $html .= '</select>';


    return $html;
}



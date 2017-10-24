<?php


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

    switch ($status){

        case "Open":
            return '<span class="label label-default">'.$status.'</span>';
        break;
        case "Assigned":
            return '<span class="label label-primary">'.$status.'</span>';
            break;
        case "Inprogress":
            return '<span class="label label-warning">'.$status.'</span>';
            break;
        case "Closed":
            return '<span class="label label-danger">'.$status.'</span>';
            break;
        case "Complete":
            return '<span class="label label-success">'.$status.'</span>';
            break;
        default:
            return '<span class="label label-info">'.$status.'</span>';
   }

}



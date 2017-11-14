<?php

namespace App\Model\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NetworkAssessment extends Model
{
    protected $dates = array('start_date', 'end_date');

    public function setStartDateAttribute($value)
    {
        if (strlen($value)) {
            $this->attributes['start_date'] = Carbon::parse($value);
        } else {
            $this->attributes['start_date'] = null;
        }
    }

    public function setEndDateAttribute($value)
    {
        if (strlen($value)) {
            $this->attributes['end_date'] = Carbon::parse($value);
        } else {
            $this->attributes['end_date'] = null;
        }
    }
}

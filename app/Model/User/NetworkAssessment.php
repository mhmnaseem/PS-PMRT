<?php

namespace App\Model\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NetworkAssessment extends Model
{
    protected $dates = array('date');
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat(config('constants.time.format'), $value);
    }
}

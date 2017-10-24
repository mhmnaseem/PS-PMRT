<?php

namespace App\Model\Common;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $dates = array('due_date','start_date','complete_date');

    public function partner(){
        return $this->belongsTo('App\Model\Partner\Partner');
    }

    public function pm(){
        return $this->belongsTo('App\Model\User\User');
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = Carbon::createFromFormat(config('constants.time.format'), $value);
    }
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat(config('constants.time.format'), $value);
    }
}

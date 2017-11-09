<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class BackEndBuildOut extends Model
{
    protected $dates = array('date');
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat(config('constants.time.format'), $value);
    }
}

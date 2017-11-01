<?php

namespace App\Model\Common;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $dates = array('due_date', 'start_date', 'complete_date');

    public function partner()
    {
        return $this->belongsTo('App\Model\Partner\Partner', 'partner_id');
    }

    public function pm()
    {
        return $this->belongsTo('App\Model\User\User', 'user_id');
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = Carbon::createFromFormat(config('constants.time.format'), $value);
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat(config('constants.time.format'), $value);
    }

    public function scopeFindBySlug($query, $slug)
    {
        $query->where('slug', '=', $slug);
    }

    public function projectPd()
    {
        return $this->hasMany('App\Model\User\Pd');
    }

    public function projectNetworkAssessment()
    {
        return $this->hasMany('App\Model\User\NetworkAssessment');
    }

    public function projectAdminTraining()
    {
        return $this->hasMany('App\Model\User\AdminTraining');
    }

    public function projectBackEndBuildOut()
    {
        return $this->hasMany('App\Model\User\BackEndBuildOut');
    }

    public function projectNumberPorting()
    {
        return $this->hasMany('App\Model\User\NumberPorting');
    }

    public function projectOnsiteDeliveryGoLive()
    {
        return $this->hasMany('App\Model\User\OnsiteDeliveryGoLive');
    }


}

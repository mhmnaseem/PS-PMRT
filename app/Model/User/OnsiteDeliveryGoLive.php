<?php

namespace App\Model\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OnsiteDeliveryGoLive extends Model
{
    protected $dates = array('start_date', 'end_date');

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat(config('constants.time.format'), $value);
    }

    public function setEndDateAttribute($value)
    {
        if (strlen($value)) {
            $this->attributes['end_date'] = Carbon::createFromFormat(config('constants.time.format'), $value);
        } else {
            $this->attributes['end_date'] = null;
        }
    }
}

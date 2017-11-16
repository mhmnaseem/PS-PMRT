<?php

namespace App\Model\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $dates = array('date');

    public function setDateAttribute($value)
    {
        if (strlen($value)) {
            $this->attributes['date'] = Carbon::parse($value);
        } else {
            $this->attributes['date'] = null;
        }
    }

}

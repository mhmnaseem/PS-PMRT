<?php

namespace App\Model\Partner;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Partner extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pms()
    {
        return $this->hasMany('App\Model\User\User');
    }

    public function admin()
    {
        return $this->belongsTo('App\Model\Admin\Admin');
    }

    public function projects(){
        return $this->hasMany('App\Model\Common\Project');
    }
}

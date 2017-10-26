<?php

namespace App\Model\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
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

    public function partner()
    {
        return $this->belongsTo('App\Model\Partner\Partner','partner_id');
    }

    public function scopeFindBySlug($query, $slug)
    {
        $query->where('slug', '=', $slug);
    }
    public function projects(){
        return $this->hasMany('App\Model\Common\Project','user_id');
    }

}

<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable=['project_id','note'];
}

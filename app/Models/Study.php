<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{

protected $guarded = ['id', 'users_id', 'goal_id'];

public function user()
{
    return $this->belongsTo('App\Models\User');
}

public function goal()
{
    return $this->hasOne('App\Models\Goal');
}

}

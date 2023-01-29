<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $table = 'goal';
    protected $guarded = ['id'];

    public function Monthly_goal()
{
    return $this->hasOne('App\Models\Monthly_goal');
}

}

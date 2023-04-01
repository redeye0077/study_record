<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{

    protected $fillable = ['users_id', 'date', 'hour', 'minutes', 'subject', 'study_time', 'month', 'duration'];


    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function goal()
    {
        return $this->hasOne('App\Models\Goal');
    }

    public function setStudyTimeAttribute($value)
    {
        $this->attributes['study_time'] = $value * 60;
    }

    public function getStudyTimeAttribute($value)
    {
        return $value / 60;
    }

}

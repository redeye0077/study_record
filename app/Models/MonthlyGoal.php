<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyGoal extends Model
{
    protected $table = 'monthly_goal';

    protected $fillable = [
        'user_id',
        'month',
        'achieved',
        'target_hour',
        'target_minutes',
    ];

    protected $casts = [
        'achieved' => 'boolean',
        'month' => 'date',
    ];
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function studies()
    {
        return $this->hasMany('App\Models\Study');
    }

    public function monthlyGoals()
    {
        return $this->hasMany(MonthlyGoal::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Group::class);
    }

    public function chatRooms()
    {
        return $this->belongsToMany(ChatRoom::class, 'chat_room_user')->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}

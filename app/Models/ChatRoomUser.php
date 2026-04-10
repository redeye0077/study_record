<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;

class ChatRoomUser extends Pivot
{
    protected $table = 'chat_room_user';

    protected $fillable = [
        'chat_room_id',
        'user_id',
    ];
}


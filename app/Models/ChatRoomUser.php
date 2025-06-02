<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRoomUser extends Pivot
{
    protected $table = 'chat_room_user';

    protected $guarded = ['id'];
}


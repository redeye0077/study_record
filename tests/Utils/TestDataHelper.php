<?php

namespace Tests\Utils;

use App\Models\User;
use App\Models\ChatRoom;

trait TestDataHelper
{
    public function createUserAndChatRoom(): array
    {
        $user = User::factory()->create();
        $room_id = config('chat.room.id');
        $room = ChatRoom::factory()->create(['id' => $room_id]);
        return [$user, $room];
    }
}

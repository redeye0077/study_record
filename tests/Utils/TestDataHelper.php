<?php

namespace Tests\Utils;

use App\Models\User;
use App\Models\ChatRoom;

trait TestDataHelper
{
    public function createUserAndChatRoom(): array
    {
        $user = User::factory()->create();
        // 部屋番号を1に固定
        $room_id = 1;
        $room = ChatRoom::factory()->create(['id' => $room_id]);
        return [$user, $room];
    }

    public function getTestMessageFirstPageRange(): array
    {
        return [1, 10]; // 1〜10件目を返す
    }

    public function getTestMessageSecondPageRange(): array
    {
        return [11, 15]; // 11〜15件目を返す
    }
}

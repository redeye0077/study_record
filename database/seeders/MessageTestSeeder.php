<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ChatRoom;
use App\Models\Message;
use Tests\Utils\TestDataHelper;


class MessageTestSeeder extends Seeder
{
    use TestDataHelper;

    public function run(): void
    {
        [$user, $room] = $this->createUserAndChatRoom(); // traitの共通処理
        $this->runWithUserAndRoom($user, $room);
    }

    public function runWithUserAndRoom(User $user, ChatRoom $room): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Message::factory()->create([
                'chat_room_id' => $room->id,
                'user_id' => $user->id,
                'message' => "テストメッセージ{$i}",
                'created_at' => now()->subMinutes(16 - $i),
            ]);
        }
    }
}

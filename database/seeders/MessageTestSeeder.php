<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ChatRoom;
use App\Models\Message;


class MessageTestSeeder extends Seeder
{
    public function run()
    {
        $user = User::factory()->create();

        // 現在はチャットルームが1つのため、id=1で固定してます。
        $room = ChatRoom::factory()->create(['id' => 1]);

        // メッセージを15件作成
        for ($i = 1; $i < 16; $i++) {
            Message::factory()->create([
                'chat_room_id' => $room->id,
                'user_id' => $user->id,
                'message' => "テストメッセージ{$i}",
                'created_at' => now()->subMinutes(16 - $i),
            ]);
        }
    }
}

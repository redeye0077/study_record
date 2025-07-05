<?php

namespace Database\Factories;

use App\Models\ChatRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChatRoom>
 */
class ChatRoomFactory extends Factory
{
    protected $model = ChatRoom::class;

    public function definition(): array
    {
        return [
            'name' => 'ChatRoom',
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        // Seeder内でuser_idやmessageなど
        // 全ての必要なフィールドを手動で明示的に渡しているので空にしています
        return [
            //
        ];
    }
}

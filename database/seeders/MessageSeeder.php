<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use Faker\Factory as Faker;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('ja_JP');

        for ($i = 0; $i < 100; $i++) {
            Message::create([
                'user_id' => rand(1, 2),
                'chat_room_id' => 1,
                'message' => $faker->realText(30),
            ]);
        }
    }
}

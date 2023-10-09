<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\ParticipantsEvent;

class particiapantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 10; $i++) {
            ParticipantsEvent::create([
                'code_participant' => (string) Str::uuid(),
                'event_id' => 1,
                'name_participant' => Str::random(10),
                'email_participant' => Str::random(10).'@gmail.com',
                'phone_participant' => Str::random(10),
                'user_participants_id' => 1,
                'checker_participants_id' => 1,
                'status_participant' => 'asdasd',
                'message_participant' => 'asdasd'
            ]);
        }
    }
}

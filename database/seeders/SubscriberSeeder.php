<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    public function run(): void
    {
        $subscribers = [
            ['email' => 'supporter1@email.com', 'is_active' => true],
            ['email' => 'helper2023@gmail.com', 'is_active' => true],
            ['email' => 'caring.heart@yahoo.com', 'is_active' => true],
            ['email' => 'palestine.supporter@email.com', 'is_active' => true],
            ['email' => 'humanitarian.aid@outlook.com', 'is_active' => true],
            ['email' => 'peace.advocate@email.com', 'is_active' => true],
            ['email' => 'global.citizen@gmail.com', 'is_active' => true],
            ['email' => 'solidarity.now@email.com', 'is_active' => true],
            ['email' => 'hope.for.gaza@yahoo.com', 'is_active' => true],
            ['email' => 'water.donor@email.com', 'is_active' => true],
            ['email' => 'medical.aid.supporter@gmail.com', 'is_active' => true],
            ['email' => 'education.matters@outlook.com', 'is_active' => true],
            ['email' => 'children.first@email.com', 'is_active' => true],
            ['email' => 'community.helper@yahoo.com', 'is_active' => true],
            ['email' => 'daily.updates@email.com', 'is_active' => true],
            ['email' => 'former.subscriber@email.com', 'is_active' => false],
            ['email' => 'inactive.user@gmail.com', 'is_active' => false],
            ['email' => 'unsubscribed@yahoo.com', 'is_active' => false],
        ];

        foreach ($subscribers as $subscriber) {
            $subscribedAt = now()->subDays(rand(7, 90));
            
            Subscriber::create([
                'email' => $subscriber['email'],
                'is_active' => $subscriber['is_active'],
                'subscribed_at' => $subscribedAt,
                'unsubscribed_at' => $subscriber['is_active'] ? null : now()->subDays(rand(1, 6)),
                'created_at' => $subscribedAt,
            ]);
        }
    }
}


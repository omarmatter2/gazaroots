<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialMediaLinks = [
            [
                'platform' => 'Instagram',
                'image' => 'instagram.svg',
                'url' => 'https://instagram.com',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'platform' => 'TikTok',
                'image' => 'tiktok.svg',
                'url' => 'https://tiktok.com',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'platform' => 'Twitter',
                'image' => 'twitter.svg',
                'url' => 'https://twitter.com',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'platform' => 'Telegram',
                'image' => 'telegram.svg',
                'url' => 'https://telegram.org',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'platform' => 'Snapchat',
                'image' => 'snapchat.svg',
                'url' => 'https://snapchat.com',
                'is_active' => true,
                'order' => 5,
            ],
        ];

        foreach ($socialMediaLinks as $link) {
            SocialMedia::create($link);
        }
    }
}

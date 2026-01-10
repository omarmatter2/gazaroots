<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            CategorySeeder::class,
            AuthorSeeder::class,
            WaterProjectSeeder::class,
            ArticleSeeder::class,
            DonationSeeder::class,
            AssistanceRequestSeeder::class,
            TestimonialSeeder::class,
            SubscriberSeeder::class,
            SocialMediaSeeder::class,
        ]);
    }
}

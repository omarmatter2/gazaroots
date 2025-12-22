<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\WaterProject;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    public function run(): void
    {
        $projects = WaterProject::all();

        $donors = [
            ['name' => 'John Smith', 'email' => 'john.smith@email.com', 'phone' => '+1-555-0101'],
            ['name' => 'Sarah Johnson', 'email' => 'sarah.j@email.com', 'phone' => '+1-555-0102'],
            ['name' => 'Mohammed Ali', 'email' => 'mali@email.com', 'phone' => '+971-50-123-4567'],
            ['name' => 'Fatima Al-Rashid', 'email' => 'fatima.r@email.com', 'phone' => '+966-50-234-5678'],
            ['name' => 'David Brown', 'email' => 'dbrown@email.com', 'phone' => '+44-20-1234-5678'],
            ['name' => 'Aisha Khan', 'email' => 'aisha.k@email.com', 'phone' => '+92-300-123-4567'],
            ['name' => 'Omar Hassan', 'email' => 'omar.h@email.com', 'phone' => '+962-79-123-4567'],
            ['name' => 'Emily Wilson', 'email' => 'emily.w@email.com', 'phone' => '+1-555-0103'],
            ['name' => 'Ahmed Mahmoud', 'email' => 'ahmed.m@email.com', 'phone' => '+20-100-123-4567'],
            ['name' => 'Lisa Anderson', 'email' => 'lisa.a@email.com', 'phone' => '+1-555-0104'],
        ];

        $paymentMethods = ['credit_card', 'paypal', 'bank_transfer', 'cash'];
        $statuses = ['completed', 'completed', 'completed', 'pending', 'failed'];
        $types = ['one_time', 'one_time', 'monthly'];

        foreach ($projects as $project) {
            $numDonations = rand(3, 8);
            
            for ($i = 0; $i < $numDonations; $i++) {
                $donor = $donors[array_rand($donors)];
                $status = $statuses[array_rand($statuses)];
                
                Donation::create([
                    'water_project_id' => $project->id,
                    'donor_name' => $donor['name'],
                    'donor_email' => $donor['email'],
                    'donor_phone' => $donor['phone'],
                    'amount' => rand(1, 50) * 10,
                    'type' => $types[array_rand($types)],
                    'status' => $status,
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'transaction_id' => $status === 'completed' ? 'TXN' . strtoupper(uniqid()) : null,
                    'notes' => rand(0, 1) ? 'May Allah bless the people of Gaza' : null,
                    'created_at' => now()->subDays(rand(1, 60)),
                ]);
            }
        }
    }
}


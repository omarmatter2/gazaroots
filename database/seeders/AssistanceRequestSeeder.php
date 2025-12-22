<?php

namespace Database\Seeders;

use App\Models\AssistanceRequest;
use Illuminate\Database\Seeder;

class AssistanceRequestSeeder extends Seeder
{
    public function run(): void
    {
        $requests = [
            [
                'full_name' => 'Khaled Abu Salem',
                'phone' => '+970-599-111-222',
                'email' => 'khaled.as@email.com',
                'location' => 'Gaza City - Al-Rimal',
                'message' => 'Our family of 8 has been displaced and we urgently need food and water supplies. We are currently staying in a school shelter.',
                'status' => 'new',
                'admin_notes' => null,
            ],
            [
                'full_name' => 'Mariam Al-Najjar',
                'phone' => '+970-599-222-333',
                'email' => 'mariam.n@email.com',
                'location' => 'Khan Younis',
                'message' => 'My elderly mother needs urgent medical supplies - insulin and blood pressure medication. She is diabetic and we ran out of medicine 3 days ago.',
                'status' => 'in_progress',
                'admin_notes' => 'Contacted local medical team. Supplies being prepared.',
            ],
            [
                'full_name' => 'Yousef Ibrahim',
                'phone' => '+970-599-333-444',
                'email' => null,
                'location' => 'Rafah',
                'message' => 'We need clean drinking water for our neighborhood. The water tanks have been empty for a week.',
                'status' => 'resolved',
                'admin_notes' => 'Water truck sent on Dec 10. Follow up scheduled for next week.',
            ],
            [
                'full_name' => 'Hana Mohammed',
                'phone' => '+970-599-444-555',
                'email' => 'hana.m@email.com',
                'location' => 'Deir al-Balah',
                'message' => 'Our children need winter clothes and blankets. The nights are very cold and we lost everything when we evacuated.',
                'status' => 'new',
                'admin_notes' => null,
            ],
            [
                'full_name' => 'Ahmad Saleh',
                'phone' => '+970-599-555-666',
                'email' => 'ahmad.s@email.com',
                'location' => 'Gaza City - Sheikh Radwan',
                'message' => 'I am a teacher and we need educational supplies for the children in our shelter. Books, notebooks, and pens.',
                'status' => 'in_progress',
                'admin_notes' => 'Educational kit being prepared. Expected delivery in 2 days.',
            ],
            [
                'full_name' => 'Layla Hassan',
                'phone' => '+970-599-666-777',
                'email' => null,
                'location' => 'Jabalia',
                'message' => 'My husband is injured and needs specialized medical care. He has shrapnel wounds that need surgery.',
                'status' => 'in_progress',
                'admin_notes' => 'Referred to MSF team. Appointment scheduled.',
            ],
            [
                'full_name' => 'Omar Al-Masri',
                'phone' => '+970-599-777-888',
                'email' => 'omar.m@email.com',
                'location' => 'Nuseirat Camp',
                'message' => 'We need baby formula and diapers for my 6-month-old daughter. The stores are all closed.',
                'status' => 'resolved',
                'admin_notes' => 'Baby supplies delivered on Dec 12.',
            ],
            [
                'full_name' => 'Sana Abu Zahra',
                'phone' => '+970-599-888-999',
                'email' => 'sana.z@email.com',
                'location' => 'Beit Hanoun',
                'message' => 'Our house was destroyed and we need temporary shelter. Family of 6 including 3 children.',
                'status' => 'new',
                'admin_notes' => null,
            ],
        ];

        foreach ($requests as $request) {
            AssistanceRequest::create([
                'full_name' => $request['full_name'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'location' => $request['location'],
                'message' => $request['message'],
                'status' => $request['status'],
                'admin_notes' => $request['admin_notes'],
                'created_at' => now()->subDays(rand(1, 14)),
            ]);
        }
    }
}


<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            [
                'name_en' => 'Ahmad Al-Masri',
                'name_ar' => 'أحمد المصري',
                'email' => 'ahmad@gazaroots.com',
                'phone' => '+970-599-123-456',
                'bio_en' => 'Senior journalist with 15 years of experience covering Gaza. Specializes in humanitarian stories and crisis reporting.',
                'bio_ar' => 'صحفي بارز مع 15 عاماً من الخبرة في تغطية غزة. متخصص في القصص الإنسانية والتقارير عن الأزمات.',
                'location' => 'Gaza City',
            ],
            [
                'name_en' => 'Fatima Hassan',
                'name_ar' => 'فاطمة حسن',
                'email' => 'fatima@gazaroots.com',
                'phone' => '+970-599-234-567',
                'bio_en' => 'Award-winning photographer and writer focusing on children and education in Gaza.',
                'bio_ar' => 'مصورة وكاتبة حائزة على جوائز تركز على الأطفال والتعليم في غزة.',
                'location' => 'Khan Younis',
            ],
            [
                'name_en' => 'Mohammed Khalil',
                'name_ar' => 'محمد خليل',
                'email' => 'mohammed@gazaroots.com',
                'phone' => '+970-599-345-678',
                'bio_en' => 'Environmental journalist specializing in water crisis and infrastructure issues.',
                'bio_ar' => 'صحفي بيئي متخصص في أزمة المياه وقضايا البنية التحتية.',
                'location' => 'Rafah',
            ],
            [
                'name_en' => 'Sara Abu Nada',
                'name_ar' => 'سارة أبو ندى',
                'email' => 'sara@gazaroots.com',
                'phone' => '+970-599-456-789',
                'bio_en' => 'Health correspondent covering medical challenges and healthcare access in Gaza.',
                'bio_ar' => 'مراسلة صحية تغطي التحديات الطبية والوصول للرعاية الصحية في غزة.',
                'location' => 'Gaza City',
            ],
            [
                'name_en' => 'Yusuf Al-Najjar',
                'name_ar' => 'يوسف النجار',
                'email' => 'yusuf@gazaroots.com',
                'phone' => '+970-599-567-890',
                'bio_en' => 'Community reporter documenting daily life and resilience stories.',
                'bio_ar' => 'مراسل مجتمعي يوثق الحياة اليومية وقصص الصمود.',
                'location' => 'Deir al-Balah',
            ],
        ];

        foreach ($authors as $authorData) {
            $author = new Author();
            $author->setTranslations('name', [
                'en' => $authorData['name_en'],
                'ar' => $authorData['name_ar'],
            ]);
            $author->slug = Str::slug($authorData['name_en']);
            $author->email = $authorData['email'];
            $author->phone = $authorData['phone'];
            $author->setTranslations('bio', [
                'en' => $authorData['bio_en'],
                'ar' => $authorData['bio_ar'],
            ]);
            $author->location = $authorData['location'];
            $author->is_active = true;
            $author->save();
        }
    }
}


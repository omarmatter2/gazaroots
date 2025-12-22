<?php

namespace Database\Seeders;

use App\Models\WaterProject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WaterProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title_en' => 'Gaza City Water Wells Project',
                'title_ar' => 'مشروع آبار مياه مدينة غزة',
                'description_en' => 'Building sustainable water wells to provide clean drinking water to thousands of families in Gaza City. This project aims to drill deep wells and install solar-powered pumping systems.',
                'description_ar' => 'بناء آبار مياه مستدامة لتوفير مياه الشرب النظيفة لآلاف العائلات في مدينة غزة. يهدف هذا المشروع إلى حفر آبار عميقة وتركيب أنظمة ضخ تعمل بالطاقة الشمسية.',
                'location' => 'Gaza City',
                'wells_built' => 12,
                'beneficiaries' => 15000,
                'families_served' => 3000,
                'neighborhoods' => 8,
            ],
            [
                'title_en' => 'Khan Younis Emergency Water Supply',
                'title_ar' => 'إمداد المياه الطارئ في خان يونس',
                'description_en' => 'Emergency water distribution and well rehabilitation project serving displaced families in Khan Younis.',
                'description_ar' => 'مشروع توزيع المياه الطارئ وإعادة تأهيل الآبار لخدمة العائلات النازحة في خان يونس.',
                'location' => 'Khan Younis',
                'wells_built' => 8,
                'beneficiaries' => 10000,
                'families_served' => 2000,
                'neighborhoods' => 5,
            ],
            [
                'title_en' => 'Rafah Border Area Water Project',
                'title_ar' => 'مشروع مياه منطقة رفح الحدودية',
                'description_en' => 'Providing water access to communities near the Rafah border crossing through mobile water tanks and new wells.',
                'description_ar' => 'توفير الوصول للمياه للمجتمعات القريبة من معبر رفح من خلال خزانات المياه المتنقلة والآبار الجديدة.',
                'location' => 'Rafah',
                'wells_built' => 5,
                'beneficiaries' => 8000,
                'families_served' => 1600,
                'neighborhoods' => 4,
            ],
            [
                'title_en' => 'Central Gaza Desalination Initiative',
                'title_ar' => 'مبادرة تحلية المياه في وسط غزة',
                'description_en' => 'Installing small-scale desalination units to convert brackish water into safe drinking water.',
                'description_ar' => 'تركيب وحدات تحلية صغيرة لتحويل المياه المالحة إلى مياه شرب آمنة.',
                'location' => 'Deir al-Balah',
                'wells_built' => 3,
                'beneficiaries' => 5000,
                'families_served' => 1000,
                'neighborhoods' => 3,
            ],
        ];

        foreach ($projects as $projectData) {
            $project = new WaterProject();
            $project->setTranslations('title', [
                'en' => $projectData['title_en'],
                'ar' => $projectData['title_ar'],
            ]);
            $project->slug = Str::slug($projectData['title_en']);
            $project->setTranslations('description', [
                'en' => $projectData['description_en'],
                'ar' => $projectData['description_ar'],
            ]);
            $project->location = $projectData['location'];
            $project->wells_built = $projectData['wells_built'];
            $project->beneficiaries = $projectData['beneficiaries'];
            $project->families_served = $projectData['families_served'];
            $project->neighborhoods = $projectData['neighborhoods'];
            $project->is_active = true;
            $project->save();
        }
    }
}


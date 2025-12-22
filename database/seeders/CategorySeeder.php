<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name_en' => 'Breaking News',
                'name_ar' => 'أخبار عاجلة',
                'description_en' => 'Latest breaking news from Gaza',
                'description_ar' => 'آخر الأخبار العاجلة من غزة',
                'order' => 1,
            ],
            [
                'name_en' => 'Human Stories',
                'name_ar' => 'قصص إنسانية',
                'description_en' => 'Personal stories of resilience and hope',
                'description_ar' => 'قصص شخصية عن الصمود والأمل',
                'order' => 2,
            ],
            [
                'name_en' => 'Water Crisis',
                'name_ar' => 'أزمة المياه',
                'description_en' => 'Coverage of water shortage and solutions',
                'description_ar' => 'تغطية نقص المياه والحلول',
                'order' => 3,
            ],
            [
                'name_en' => 'Health & Medical',
                'name_ar' => 'الصحة والطب',
                'description_en' => 'Healthcare challenges and medical aid',
                'description_ar' => 'التحديات الصحية والمساعدات الطبية',
                'order' => 4,
            ],
            [
                'name_en' => 'Education',
                'name_ar' => 'التعليم',
                'description_en' => 'Education under difficult circumstances',
                'description_ar' => 'التعليم في ظل الظروف الصعبة',
                'order' => 5,
            ],
            [
                'name_en' => 'Aid & Relief',
                'name_ar' => 'الإغاثة والمساعدات',
                'description_en' => 'Humanitarian aid and relief efforts',
                'description_ar' => 'جهود الإغاثة والمساعدات الإنسانية',
                'order' => 6,
            ],
            [
                'name_en' => 'Community',
                'name_ar' => 'المجتمع',
                'description_en' => 'Community initiatives and solidarity',
                'description_ar' => 'مبادرات المجتمع والتضامن',
                'order' => 7,
            ],
            [
                'name_en' => 'Children & Youth',
                'name_ar' => 'الأطفال والشباب',
                'description_en' => 'Stories about children and young people',
                'description_ar' => 'قصص عن الأطفال والشباب',
                'order' => 8,
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = new Category();
            $category->setTranslations('name', [
                'en' => $categoryData['name_en'],
                'ar' => $categoryData['name_ar'],
            ]);
            $category->slug = Str::slug($categoryData['name_en']);
            $category->setTranslations('description', [
                'en' => $categoryData['description_en'],
                'ar' => $categoryData['description_ar'],
            ]);
            $category->is_active = true;
            $category->order = $categoryData['order'];
            $category->save();
        }
    }
}


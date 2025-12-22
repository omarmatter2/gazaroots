<?php

namespace Database\Seeders;

use App\Models\NavItem;
use Illuminate\Database\Seeder;

class NavItemSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing
        NavItem::truncate();

        // Home
        NavItem::create([
            'title' => ['en' => 'Home', 'ar' => 'الرئيسية'],
            'url' => 'home',
            'type' => 'link',
            'order' => 1,
        ]);

        // Lifesaving Programs (Dropdown)
        $programs = NavItem::create([
            'title' => ['en' => 'Lifesaving Programs', 'ar' => 'برامج إنقاذ الحياة'],
            'url' => null,
            'type' => 'dropdown',
            'order' => 2,
        ]);

        // Dropdown children
        $children = [
            ['en' => 'Food', 'ar' => 'الغذاء'],
            ['en' => 'Housing', 'ar' => 'الإسكان'],
            ['en' => 'Baby Care', 'ar' => 'رعاية الأطفال'],
            ['en' => 'Family', 'ar' => 'العائلة'],
            ['en' => 'Water', 'ar' => 'المياه', 'url' => 'water.index'],
        ];

        foreach ($children as $i => $child) {
            NavItem::create([
                'parent_id' => $programs->id,
                'title' => ['en' => $child['en'], 'ar' => $child['ar']],
                'url' => $child['url'] ?? '#',
                'type' => 'link',
                'order' => $i + 1,
            ]);
        }

        // Other menu items
        NavItem::create([
            'title' => ['en' => 'Culture', 'ar' => 'الثقافة'],
            'url' => '#',
            'type' => 'link',
            'order' => 3,
        ]);

        NavItem::create([
            'title' => ['en' => 'Survivors', 'ar' => 'الناجون'],
            'url' => '#',
            'type' => 'link',
            'order' => 4,
        ]);

        NavItem::create([
            'title' => ['en' => 'Testimonies', 'ar' => 'الشهادات'],
            'url' => 'testimonials.index',
            'type' => 'link',
            'order' => 5,
        ]);

        NavItem::create([
            'title' => ['en' => 'Solidarity', 'ar' => 'التضامن'],
            'url' => '#',
            'type' => 'link',
            'order' => 6,
        ]);

        // Buttons (right side)
        NavItem::create([
            'title' => ['en' => 'Request Help?', 'ar' => 'طلب مساعدة؟'],
            'url' => 'request-help',
            'type' => 'button',
            'css_class' => 'gr-btn--ghost',
            'order' => 100,
        ]);

        NavItem::create([
            'title' => ['en' => 'Donate Now', 'ar' => 'تبرع الآن'],
            'url' => 'water.index',
            'type' => 'button',
            'css_class' => 'gr-btn--donate',
            'order' => 101,
        ]);
    }
}

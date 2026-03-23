<?php

namespace Database\Seeders;

use App\Models\NavItem;
use Illuminate\Database\Seeder;

class DonateButtonSeeder extends Seeder
{
    public function run(): void
    {
        NavItem::create([
            'title' => ['en' => 'Donate Now', 'ar' => 'تبرع الآن'],
            'url' => 'https://chuffed.org/project/157636-gazas-roots-programs',
            'type' => 'button',
            'target' => '_blank',
            'css_class' => 'gr-btn--donate',
            'order' => 101,
        ]);
    }
}

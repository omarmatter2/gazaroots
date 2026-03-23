<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('nav_items')
            ->where('css_class', 'gr-btn--donate')
            ->update([
                'url' => 'https://chuffed.org/project/157636-gazas-roots-programs',
                'target' => '_blank',
            ]);
    }

    public function down(): void
    {
        DB::table('nav_items')
            ->where('css_class', 'gr-btn--donate')
            ->update([
                'url' => 'water.index',
                'target' => '_self',
            ]);
    }
};

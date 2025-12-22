<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Categories: name, description
        $this->convertColumns('categories', ['name', 'description']);

        // Articles: title, excerpt, content
        $this->convertColumns('articles', ['title', 'excerpt', 'content']);

        // Authors: name, bio
        $this->convertColumns('authors', ['name', 'bio']);

        // Water Projects: title, description
        $this->convertColumns('water_projects', ['title', 'description']);

        // Testimonials: name, content
        $this->convertColumns('testimonials', ['name', 'content']);

        // Newsletters: subject, content
        $this->convertColumns('newsletters', ['subject', 'content']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Categories
        $this->revertColumns('categories', ['name', 'description']);

        // Articles
        $this->revertColumns('articles', ['title', 'excerpt', 'content']);

        // Authors
        $this->revertColumns('authors', ['name', 'bio']);

        // Water Projects
        $this->revertColumns('water_projects', ['title', 'description']);

        // Testimonials
        $this->revertColumns('testimonials', ['name', 'content']);

        // Newsletters
        $this->revertColumns('newsletters', ['subject', 'content']);
    }

    private function convertColumns(string $table, array $columns): void
    {
        // Get existing data
        $records = DB::table($table)->get();

        // Add new JSON columns and migrate data
        Schema::table($table, function (Blueprint $t) use ($columns) {
            foreach ($columns as $column) {
                $t->json($column)->nullable();
            }
        });

        // Migrate data from _en/_ar columns to JSON
        foreach ($records as $record) {
            $updates = [];
            foreach ($columns as $column) {
                $enCol = "{$column}_en";
                $arCol = "{$column}_ar";
                $updates[$column] = json_encode([
                    'en' => $record->$enCol ?? '',
                    'ar' => $record->$arCol ?? '',
                ]);
            }
            DB::table($table)->where('id', $record->id)->update($updates);
        }

        // Drop old columns
        Schema::table($table, function (Blueprint $t) use ($columns) {
            foreach ($columns as $column) {
                $t->dropColumn(["{$column}_en", "{$column}_ar"]);
            }
        });
    }

    private function revertColumns(string $table, array $columns): void
    {
        // Get existing data
        $records = DB::table($table)->get();

        // Add old columns back
        Schema::table($table, function (Blueprint $t) use ($columns) {
            foreach ($columns as $column) {
                $t->string("{$column}_en")->nullable();
                $t->string("{$column}_ar")->nullable();
            }
        });

        // Migrate data from JSON back to _en/_ar columns
        foreach ($records as $record) {
            $updates = [];
            foreach ($columns as $column) {
                $json = json_decode($record->$column, true) ?? [];
                $updates["{$column}_en"] = $json['en'] ?? '';
                $updates["{$column}_ar"] = $json['ar'] ?? '';
            }
            DB::table($table)->where('id', $record->id)->update($updates);
        }

        // Drop JSON columns
        Schema::table($table, function (Blueprint $t) use ($columns) {
            foreach ($columns as $column) {
                $t->dropColumn($column);
            }
        });
    }
};

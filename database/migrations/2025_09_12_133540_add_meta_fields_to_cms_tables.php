<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $tables = [
            'contact_us_cms',
            'content_type_cms',
            'entertainment_cms',
            'home_cms',
            'plan_cms',
            'subscribe_cms',
            'about_us'
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->string('meta_title')->nullable()->after('id');
                $table->string('meta_keyword')->nullable()->after('meta_title');
                $table->text('meta_description')->nullable()->after('meta_keyword');
            });
        }
    }

    public function down(): void
    {
        $tables = [
            'contact_us_cms',
            'content_type_cms',
            'entertainment_cms',
            'home_cms',
            'plan_cms',
            'subscribe_cms',
            'about_us'
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn(['meta_title', 'meta_keyword', 'meta_description']);
            });
        }
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('custom_pages', function (Blueprint $table) {
            $table->string('type')->default('page')->after('slug'); // 'page', 'link', 'button'
            $table->string('parent_section')->nullable()->after('nav_section'); // 'movilidad', 'convenios', 'la_ogi'
            $table->string('file_path')->nullable()->after('external_url');
            $table->boolean('open_in_new_tab')->default(false)->after('file_path');
            $table->string('badge')->nullable()->after('open_in_new_tab');
            $table->string('badge_en')->nullable()->after('badge');
            $table->string('button_style')->nullable()->after('badge_en');
            $table->longText('content')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_pages', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'parent_section',
                'file_path',
                'open_in_new_tab',
                'badge',
                'badge_en',
                'button_style',
            ]);
            $table->longText('content')->nullable(false)->change();
        });
    }
};

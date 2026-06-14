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
        Schema::table('property_contents', function (Blueprint $table) {
            $table->string('hero_image')->nullable()->after('is_active');
            $table->string('hero_badge')->nullable()->after('hero_image');
            $table->string('hero_subtitle')->nullable()->after('hero_badge');
            $table->string('hero_title')->nullable()->after('hero_subtitle');
            $table->string('hero_accent')->nullable()->after('hero_title');
            $table->text('hero_tagline')->nullable()->after('hero_accent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_contents', function (Blueprint $table) {
            $table->dropColumn(['hero_image', 'hero_badge', 'hero_subtitle', 'hero_title', 'hero_accent', 'hero_tagline']);
        });
    }
};

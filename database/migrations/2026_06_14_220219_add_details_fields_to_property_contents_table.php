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
            $table->string('details_image')->nullable()->after('hero_tagline');
            $table->string('details_title')->nullable()->after('details_image');
            $table->text('details_intro')->nullable()->after('details_title');
            $table->text('details_description')->nullable()->after('details_intro');
            $table->json('feature_list')->nullable()->after('details_description');
            $table->string('life_title')->nullable()->after('feature_list');
            $table->string('surf_title')->nullable()->after('life_title');
            $table->text('life_text')->nullable()->after('surf_title');
            $table->text('surf_text')->nullable()->after('life_text');
            $table->json('life_highlights')->nullable()->after('surf_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_contents', function (Blueprint $table) {
            $table->dropColumn(['details_image', 'details_title', 'details_intro', 'details_description', 'feature_list', 'life_title', 'surf_title', 'life_text', 'surf_text', 'life_highlights']);
        });
    }
};

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
            $table->string('video_1_src')->nullable()->after('beach_highlights');
            $table->string('video_1_label')->nullable()->after('video_1_src');
            $table->string('video_2_src')->nullable()->after('video_1_label');
            $table->string('video_2_label')->nullable()->after('video_2_src');
            $table->string('video_title')->nullable()->after('video_2_label');
            $table->text('video_intro')->nullable()->after('video_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_contents', function (Blueprint $table) {
            $table->dropColumn(['video_1_src', 'video_1_label', 'video_2_src', 'video_2_label', 'video_title', 'video_intro']);
        });
    }
};

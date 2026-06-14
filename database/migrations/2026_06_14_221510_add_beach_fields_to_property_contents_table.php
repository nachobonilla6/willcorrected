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
            $table->string('beach_image_1')->nullable()->after('life_highlights');
            $table->string('beach_image_2')->nullable()->after('beach_image_1');
            $table->text('beach_intro')->nullable()->after('beach_image_2');
            $table->text('beach_text_1')->nullable()->after('beach_intro');
            $table->text('beach_text_2')->nullable()->after('beach_text_1');
            $table->string('beach_highlights_title')->nullable()->after('beach_text_2');
            $table->string('surfing_title')->nullable()->after('beach_highlights_title');
            $table->string('sunset_title')->nullable()->after('surfing_title');
            $table->text('surfing_text')->nullable()->after('sunset_title');
            $table->text('sunset_text')->nullable()->after('surfing_text');
            $table->json('beach_highlights')->nullable()->after('sunset_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_contents', function (Blueprint $table) {
            $table->dropColumn(['beach_image_1', 'beach_image_2', 'beach_intro', 'beach_text_1', 'beach_text_2', 'beach_highlights_title', 'surfing_title', 'sunset_title', 'surfing_text', 'sunset_text', 'beach_highlights']);
        });
    }
};

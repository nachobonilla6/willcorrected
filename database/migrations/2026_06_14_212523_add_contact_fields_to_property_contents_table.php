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
            $table->string('contact_title')->nullable()->after('is_active');
            $table->string('owner_name')->nullable()->after('contact_title');
            $table->text('contact_intro')->nullable()->after('owner_name');
            $table->string('contact_email')->nullable()->after('contact_intro');
            $table->string('contact_phone')->nullable()->after('contact_email');
            $table->string('contact_whatsapp')->nullable()->after('contact_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_contents', function (Blueprint $table) {
            $table->dropColumn(['contact_title', 'owner_name', 'contact_intro', 'contact_email', 'contact_phone', 'contact_whatsapp']);
        });
    }
};

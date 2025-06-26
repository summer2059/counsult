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
        Schema::table('testimonial_banners', function (Blueprint $table) {
            $table->string('jp_title')->nullable()->after('title');
            $table->string('jp_slug')->nullable()->after('slug');
            $table->string('image2')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonial_banners', function (Blueprint $table) {
            //
        });
    }
};

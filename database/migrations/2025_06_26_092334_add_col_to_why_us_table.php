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
        Schema::table('why_us', function (Blueprint $table) {
            $table->string('jp_title')->nullable();
            $table->string('jp_slug')->nullable();
            $table->string('image2')->nullable();
            $table->longText('jp_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('why_us', function (Blueprint $table) {
            //
        });
    }
};

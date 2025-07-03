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
        Schema::table('we_offers', function (Blueprint $table) {
            $table->string('jp_title')->nullable();
            $table->string('jp_slug')->nullable();
            $table->string('image2')->nullable();
            $table->longText('jp_description')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('we_offers', function (Blueprint $table) {
            //
        });
    }
};

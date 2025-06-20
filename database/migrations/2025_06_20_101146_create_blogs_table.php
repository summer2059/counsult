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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('jp_title')->nullable();
            $table->string('np_title')->nullable();
            $table->string('jp_slug')->nullable();
            $table->string('np_slug')->nullable();
            $table->unsignedBigInteger('blog_category_id')->nullable();
            $table->foreign('blog_category_id')->references('id')->on('blog_categories')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->text('jp_description')->nullable();
            $table->text('np_description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(0);
            $table->enum('type', ['english', 'nepali', 'japanese'])->default('english');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

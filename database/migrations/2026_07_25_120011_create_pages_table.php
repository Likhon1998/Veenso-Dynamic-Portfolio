<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('meta_title');
            $table->text('meta_description');
            $table->string('hero_headline')->nullable();
            $table->string('hero_subheadline')->nullable();
            $table->longText('content')->nullable();
            $table->json('content_blocks')->nullable();
            $table->string('status')->default('published');
            $table->string('featured_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};

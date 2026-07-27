<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->text('description');
            $table->string('client_name')->nullable();
            $table->string('year')->nullable();
            $table->json('service_tags')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('status')->default('published');
            $table->integer('sort_order')->default(0);
            $table->string('featured_image')->nullable();
            $table->string('meta_title');
            $table->text('meta_description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_items');
    }
};

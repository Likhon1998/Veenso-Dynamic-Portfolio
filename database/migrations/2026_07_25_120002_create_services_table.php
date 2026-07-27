<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary');
            $table->longText('description');
            $table->string('icon')->nullable();
            $table->json('benefits')->nullable();
            $table->json('process_steps')->nullable();
            $table->json('tools')->nullable();
            $table->json('faqs')->nullable();
            $table->json('problems')->nullable();
            $table->text('who_for')->nullable();
            $table->json('ideal_clients')->nullable();
            $table->json('why_choose')->nullable();
            $table->text('related_notes')->nullable();
            $table->string('cta_text');
            $table->string('cta_url')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->integer('sort_order')->default(0);
            $table->string('status')->default('published');
            $table->string('featured_image')->nullable();
            $table->string('meta_title');
            $table->text('meta_description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

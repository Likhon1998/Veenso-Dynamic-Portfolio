<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client_name');
            $table->longText('challenge');
            $table->longText('strategy');
            $table->longText('implementation');
            $table->longText('results');
            $table->json('stats')->nullable();
            $table->string('service_category')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('status')->default('published');
            $table->integer('sort_order')->default(0);
            $table->string('featured_image')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('meta_title');
            $table->text('meta_description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_studies');
    }
};

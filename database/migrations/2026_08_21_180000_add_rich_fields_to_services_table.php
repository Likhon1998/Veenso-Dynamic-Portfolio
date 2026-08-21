<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('headline')->nullable()->after('summary');
            $table->string('secondary_cta_text')->nullable()->after('cta_url');
            $table->string('secondary_cta_url')->nullable()->after('secondary_cta_text');
            $table->json('hero_badges')->nullable()->after('icon');
            $table->json('key_stats')->nullable()->after('hero_badges');
            $table->json('sub_services')->nullable()->after('key_stats');
            $table->json('problem_matrix')->nullable()->after('problems');
            $table->json('deliverables')->nullable()->after('benefits');
            $table->json('gains')->nullable()->after('deliverables');
            $table->json('metrics_table')->nullable()->after('gains');
            $table->json('audiences')->nullable()->after('who_for');
            $table->json('comparison')->nullable()->after('why_choose');
            $table->json('packages')->nullable()->after('comparison');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'headline',
                'secondary_cta_text',
                'secondary_cta_url',
                'hero_badges',
                'key_stats',
                'sub_services',
                'problem_matrix',
                'deliverables',
                'gains',
                'metrics_table',
                'audiences',
                'comparison',
                'packages',
            ]);
        });
    }
};

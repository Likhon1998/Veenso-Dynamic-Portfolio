<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'headline',
        'description',
        'icon',
        'hero_badges',
        'key_stats',
        'sub_services',
        'benefits',
        'deliverables',
        'gains',
        'process_steps',
        'tools',
        'faqs',
        'problems',
        'problem_matrix',
        'who_for',
        'audiences',
        'ideal_clients',
        'why_choose',
        'comparison',
        'packages',
        'metrics_table',
        'related_notes',
        'cta_text',
        'cta_url',
        'secondary_cta_text',
        'secondary_cta_url',
        'is_primary',
        'sort_order',
        'status',
        'featured_image',
        'meta_title',
        'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'hero_badges' => 'array',
            'key_stats' => 'array',
            'sub_services' => 'array',
            'benefits' => 'array',
            'deliverables' => 'array',
            'gains' => 'array',
            'process_steps' => 'array',
            'tools' => 'array',
            'faqs' => 'array',
            'problems' => 'array',
            'problem_matrix' => 'array',
            'audiences' => 'array',
            'ideal_clients' => 'array',
            'why_choose' => 'array',
            'comparison' => 'array',
            'packages' => 'array',
            'metrics_table' => 'array',
            'is_primary' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Service $service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

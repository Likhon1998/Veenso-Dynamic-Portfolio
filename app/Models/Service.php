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
        'description',
        'icon',
        'benefits',
        'process_steps',
        'tools',
        'faqs',
        'problems',
        'who_for',
        'ideal_clients',
        'why_choose',
        'related_notes',
        'cta_text',
        'cta_url',
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
            'benefits' => 'array',
            'process_steps' => 'array',
            'tools' => 'array',
            'faqs' => 'array',
            'problems' => 'array',
            'ideal_clients' => 'array',
            'why_choose' => 'array',
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

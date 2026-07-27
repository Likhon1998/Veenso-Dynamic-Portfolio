<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CaseStudy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'client_name',
        'challenge',
        'strategy',
        'implementation',
        'results',
        'stats',
        'service_category',
        'featured',
        'status',
        'sort_order',
        'featured_image',
        'excerpt',
        'meta_title',
        'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'stats' => 'array',
            'featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (CaseStudy $caseStudy) {
            if (empty($caseStudy->slug)) {
                $caseStudy->slug = Str::slug($caseStudy->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

<?php

namespace App\Models;

use App\Traits\HasAutoTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    use HasAutoTranslation;

    protected $fillable = [
        'title',
        'title_en',
        'image_path',
        'is_active_carousel',
        'is_featured',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'is_active_carousel' => 'boolean',
            'is_featured' => 'boolean',
            'order' => 'integer',
        ];
    }

    protected array $autoTranslatable = [
        'title' => 'title_en',
    ];

    public function scopeActiveCarousel(Builder $query): Builder
    {
        return $query->where('is_active_carousel', true)->orderBy('order')->orderBy('id', 'asc');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order')->orderBy('id', 'desc');
    }
}


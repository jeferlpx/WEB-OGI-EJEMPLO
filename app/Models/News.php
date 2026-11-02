<?php

namespace App\Models;

use App\Traits\HasAutoTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasAutoTranslation;

    protected array $autoTranslatable = [
        'title' => 'title_en',
        'summary' => 'summary_en',
        'content' => 'content_en',
    ];
    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'category',
        'published_at',
        'featured_image_path',
        'summary',
        'summary_en',
        'content',
        'content_en',
        'is_featured',
        'publication_status',
        'author_name',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'is_featured' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('publication_status', 'publicado')
                     ->where('published_at', '<=', now());
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }
}

<?php

namespace App\Models;

use App\Traits\HasAutoTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasAutoTranslation;

    protected array $autoTranslatable = [
        'title' => 'title_en',
        'description' => 'description_en',
    ];
    protected $fillable = [
        'title',
        'title_en',
        'category',
        'target_audience',
        'file_path',
        'file_size_kb',
        'file_ext',
        'description',
        'description_en',
        'download_count',
        'publication_status',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('publication_status', 'publicado');
    }
}

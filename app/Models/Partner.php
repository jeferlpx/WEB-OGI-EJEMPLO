<?php

namespace App\Models;

use App\Traits\HasAutoTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasAutoTranslation;

    protected array $autoTranslatable = [
        'description' => 'description_en',
    ];
    protected $fillable = [
        'name',
        'category',
        'logo_path',
        'website_url',
        'description',
        'description_en',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}

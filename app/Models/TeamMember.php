<?php

namespace App\Models;

use App\Traits\HasAutoTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasAutoTranslation;

    protected array $autoTranslatable = [
        'role_title' => 'role_title_en',
        'bio' => 'bio_en',
    ];
    protected $fillable = [
        'name',
        'role_title',
        'role_title_en',
        'department',
        'email',
        'phone',
        'bio',
        'bio_en',
        'photo_path',
        'cv_file_path',
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

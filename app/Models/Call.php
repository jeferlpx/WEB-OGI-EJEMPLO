<?php

namespace App\Models;

use App\Traits\HasAutoTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasAutoTranslation;

    protected array $autoTranslatable = [
        'title' => 'title_en',
        'summary' => 'summary_en',
        'description' => 'description_en',
    ];
    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'call_type',
        'target_audience',
        'start_date',
        'deadline_date',
        'status',
        'publication_status',
        'summary',
        'summary_en',
        'description',
        'description_en',
        'requirements',
        'benefits',
        'requirements_file_path',
        'apply_url',
        'contact_email',
        'is_featured',
        'banner_image_path',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'deadline_date' => 'date',
            'is_featured' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('publication_status', 'publicado');
    }

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', 'abierta');
    }

    public function getComputedStatusAttribute(): string
    {
        if ($this->deadline_date) {
            if ($this->deadline_date->isPast()) {
                return 'cerrada';
            }
        }
        return $this->status ?: 'abierta';
    }
}

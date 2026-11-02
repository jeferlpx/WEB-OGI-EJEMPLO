<?php

namespace App\Models;

use App\Traits\HasAutoTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasAutoTranslation;

    protected array $autoTranslatable = [
        'question' => 'question_en',
        'answer' => 'answer_en',
    ];
    protected $fillable = [
        'category',
        'question',
        'question_en',
        'answer',
        'answer_en',
        'order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)->orderBy('order');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agreement extends Model
{
    protected $fillable = [
        'code',
        'title',
        'institution_id',
        'agreement_type_id',
        'scope',
        'faculty_scope',
        'objective',
        'signed_at',
        'expires_at',
        'is_indefinite',
        'status',
        'publication_status',
        'file_path',
        'external_url',
        'internal_notes',
        'contact_unit',
    ];

    protected function casts(): array
    {
        return [
            'signed_at' => 'date',
            'expires_at' => 'date',
            'is_indefinite' => 'boolean',
        ];
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(AgreementType::class, 'agreement_type_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('publication_status', 'publicado');
    }

    public function scopeInternational(Builder $query): Builder
    {
        return $query->where('scope', 'internacional');
    }

    public function scopeNational(Builder $query): Builder
    {
        return $query->where('scope', 'nacional');
    }

    /**
     * Compute real-time active status based on verified dates
     */
    public function getComputedStatusAttribute(): string
    {
        if ($this->is_indefinite) {
            return 'vigente';
        }

        if (!$this->expires_at) {
            return $this->status ?: 'vigente';
        }

        $now = now()->startOfDay();
        $expiry = $this->expires_at->startOfDay();

        if ($expiry->isPast()) {
            return 'vencido';
        }

        if ($expiry->diffInDays($now) <= 90) {
            return 'por_vencer';
        }

        return 'vigente';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Institution extends Model
{
    protected $fillable = [
        'name',
        'acronym',
        'country_id',
        'city',
        'website_url',
        'logo_path',
        'type',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function agreements(): HasMany
    {
        return $this->hasMany(Agreement::class);
    }
}

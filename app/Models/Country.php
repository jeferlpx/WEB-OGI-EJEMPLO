<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = ['name', 'code', 'flag_emoji', 'region'];

    public static array $englishCountryMap = [
        'Alemania' => 'Germany',
        'Argentina' => 'Argentina',
        'Austria' => 'Austria',
        'Bélgica' => 'Belgium',
        'Brasil' => 'Brazil',
        'Chile' => 'Chile',
        'Colombia' => 'Colombia',
        'Ecuador' => 'Ecuador',
        'España' => 'Spain',
        'Estados Unidos' => 'United States',
        'Finlandia' => 'Finland',
        'Francia' => 'France',
        'Honduras' => 'Honduras',
        'India' => 'India',
        'Italia' => 'Italy',
        'Japón' => 'Japan',
        'México' => 'Mexico',
        'Perú' => 'Peru',
        'Portugal' => 'Portugal',
        'Reino Unido' => 'United Kingdom',
        'Rusia' => 'Russia',
        'Turquía' => 'Turkey',
    ];

    public function getLocalizedNameAttribute(): string
    {
        $locale = app()->getLocale() ?: session('locale', 'es');
        if ($locale === 'en') {
            return static::$englishCountryMap[$this->name] ?? $this->name;
        }
        return $this->name;
    }

    public function institutions(): HasMany
    {
        return $this->hasMany(Institution::class);
    }
}

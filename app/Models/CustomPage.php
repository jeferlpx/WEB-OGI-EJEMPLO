<?php

namespace App\Models;

use App\Traits\HasAutoTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CustomPage extends Model
{
    use HasAutoTranslation;

    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'type', // 'page', 'link', 'button'
        'nav_section',
        'parent_section',
        'summary',
        'summary_en',
        'content',
        'content_en',
        'featured_image_path',
        'banner_image_path',
        'external_url',
        'file_path',
        'open_in_new_tab',
        'badge',
        'badge_en',
        'button_style',
        'show_in_nav',
        'is_published',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'show_in_nav' => 'boolean',
            'is_published' => 'boolean',
            'open_in_new_tab' => 'boolean',
            'order' => 'integer',
        ];
    }

    protected array $autoTranslatable = [
        'title' => 'title_en',
        'summary' => 'summary_en',
        'content' => 'content_en',
        'badge' => 'badge_en',
    ];

    public static array $navSections = [
        'movilidad_entrante' => 'Movilidad Entrante (Incoming)',
        'movilidad_saliente' => 'Movilidad Saliente (Outcoming)',
        'summer_camp' => 'Summer Camp UNALM',
        'movilidad_general' => 'Movilidad - General',
        'redes_internacionales' => 'Redes Internacionales',
        'redes_nacionales' => 'Redes Nacionales',
        'aliados' => 'Aliados Estratégicos',
        'cooperacion' => 'Cooperación y Alianzas',
        'la_ogi' => 'La OGI Institucional',
        'convocatorias' => 'Becas y Oportunidades',
        'enlaces_rapidos' => 'Enlaces Rápidos y Botones',
        'general' => 'Otras Secciones / General',
    ];

    public static array $navSectionsEn = [
        'movilidad_entrante' => 'Incoming Mobility (Study at UNALM)',
        'movilidad_saliente' => 'Outgoing Mobility (Study Abroad)',
        'summer_camp' => 'UNALM Summer Camp',
        'movilidad_general' => 'Mobility - General',
        'redes_internacionales' => 'International Networks',
        'redes_nacionales' => 'National Networks',
        'aliados' => 'Strategic Allies',
        'cooperacion' => 'Cooperation & Partnerships',
        'la_ogi' => 'About OGI',
        'convocatorias' => 'Grants & Opportunities',
        'enlaces_rapidos' => 'Quick Links & Action Buttons',
        'general' => 'Other Sections / General',
    ];

    public function getSectionLabelAttribute(): string
    {
        $locale = app()->getLocale() ?: session('locale', 'es');
        if ($locale === 'en') {
            return static::$navSectionsEn[$this->nav_section] ?? ucfirst(str_replace('_', ' ', $this->nav_section));
        }
        return static::$navSections[$this->nav_section] ?? ucfirst(str_replace('_', ' ', $this->nav_section));
    }

    public function getUrlAttribute(): string
    {
        if (!empty($this->file_path)) {
            return asset($this->file_path);
        }
        if (!empty($this->external_url)) {
            return $this->external_url;
        }
        return route('pages.show', $this->slug);
    }

    public function getTargetAttribute(): string
    {
        if ($this->open_in_new_tab) {
            return '_blank';
        }
        if (!empty($this->file_path) && str_ends_with(strtolower($this->file_path), '.pdf')) {
            return '_blank';
        }
        if (!empty($this->external_url) && (str_starts_with($this->external_url, 'http://') || str_starts_with($this->external_url, 'https://'))) {
            return '_blank';
        }
        return '_self';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeInNav(Builder $query): Builder
    {
        return $query->where('show_in_nav', true)
                     ->where('is_published', true)
                     ->orderBy('order')
                     ->orderBy('id', 'asc');
    }

    public function scopeForSection(Builder $query, string $section): Builder
    {
        return $query->where('nav_section', $section)
                     ->where('is_published', true)
                     ->orderBy('order')
                     ->orderBy('title');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order')->orderBy('id', 'asc');
    }
}

<?php

namespace App\Traits;

use App\Services\TranslationService;

trait HasAutoTranslation
{
    /**
     * Boot the trait to hook into the Eloquent saving event.
     */
    public static function bootHasAutoTranslation(): void
    {
        static::saving(function ($model) {
            $fields = $model->getAutoTranslatableFields();

            foreach ($fields as $source => $target) {
                $sourceVal = $model->{$source} ?? null;
                $targetVal = $model->{$target} ?? null;

                // If source has content and target is null/empty, auto-translate
                if (!empty($sourceVal) && (empty($targetVal) || trim($targetVal) === '')) {
                    try {
                        $model->{$target} = TranslationService::translate($sourceVal, 'es', 'en');
                    } catch (\Throwable $e) {
                        // Keep saving even if external API fails
                    }
                }
            }
        });
    }

    /**
     * Get defined auto-translatable fields mapping [ 'source_field' => 'target_en_field' ].
     */
    public function getAutoTranslatableFields(): array
    {
        return property_exists($this, 'autoTranslatable') ? $this->autoTranslatable : [];
    }

    /**
     * Localized attribute resolver:
     * Returns English if current locale is 'en', falling back to auto-translating on-the-fly
     * and quietly saving to the database so it's permanently stored.
     */
    public function trans(string $field): ?string
    {
        $locale = app()->getLocale() ?: session('locale', 'es');

        if ($locale === 'en') {
            $targetField = $field . '_en';
            $existingEn = $this->getAttribute($targetField);

            if (!empty($existingEn) && trim((string)$existingEn) !== '') {
                return $existingEn;
            }

            // If empty, translate on-the-fly
            $sourceVal = $this->getAttribute($field);
            if (!empty($sourceVal)) {
                $translated = TranslationService::translate($sourceVal, 'es', 'en');
                if (!empty($translated)) {
                    // Quietly update DB if model exists
                    if ($this->exists) {
                        try {
                            $this->updateQuietly([$targetField => $translated]);
                        } catch (\Throwable $e) {
                            // Ignored
                        }
                    }
                    return $translated;
                }
            }
        }

        return $this->getAttribute($field);
    }

    /**
     * Alias for trans($field)
     */
    public function getTranslated(string $field): ?string
    {
        return $this->trans($field);
    }
}

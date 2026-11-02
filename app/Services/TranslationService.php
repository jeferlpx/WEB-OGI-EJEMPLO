<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    /**
     * Cache prefix to avoid collisions.
     */
    protected const CACHE_PREFIX = 'trans_v2_';

    /**
     * User-Agent simulating a modern browser for external requests.
     */
    protected const USER_AGENT = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36';

    /**
     * Translate a given text or HTML content from source language to target language.
     * Automatically handles caching, provider failover, and HTML tag preservation.
     */
    public static function translate(?string $text, string $from = 'es', string $to = 'en'): string
    {
        $text = trim((string)$text);
        if ($text === '' || $from === $to) {
            return $text;
        }

        // Cache key using hash of input and language pair
        $cacheKey = self::CACHE_PREFIX . md5($from . '_' . $to . '_' . $text);

        return Cache::rememberForever($cacheKey, function () use ($text, $from, $to) {
            return self::executeTranslation($text, $from, $to);
        });
    }

    /**
     * Batch translation helper.
     */
    public static function translateBatch(array $texts, string $from = 'es', string $to = 'en'): array
    {
        $results = [];
        foreach ($texts as $key => $val) {
            $results[$key] = self::translate($val, $from, $to);
        }
        return $results;
    }

    /**
     * Executes translation through redundant providers.
     */
    protected static function executeTranslation(string $text, string $from, string $to): string
    {
        // Provider 1: Google Translate API (Dict / Chrome Ex Client)
        try {
            $translated = self::translateViaGoogle($text, $from, $to);
            if (!empty($translated)) {
                return $translated;
            }
        } catch (\Throwable $e) {
            Log::warning("TranslationService: Google provider failed - " . $e->getMessage());
        }

        // Provider 2: MyMemory API Fallback
        try {
            $translated = self::translateViaMyMemory($text, $from, $to);
            if (!empty($translated)) {
                return $translated;
            }
        } catch (\Throwable $e) {
            Log::warning("TranslationService: MyMemory provider failed - " . $e->getMessage());
        }

        // Fallback: return original text if all translation providers are unavailable
        return $text;
    }

    /**
     * Google Translate via client=dict-chrome-ex / gtx
     */
    protected static function translateViaGoogle(string $text, string $from, string $to): ?string
    {
        $url = 'https://translate.googleapis.com/translate_a/single';

        // Split long text into paragraphs/chunks if > 2500 characters
        if (mb_strlen($text) > 2500) {
            return self::translateLongTextChunks($text, $from, $to, 'google');
        }

        $response = Http::withoutVerifying()
            ->timeout(8)
            ->withHeaders(['User-Agent' => self::USER_AGENT])
            ->get($url, [
                'client' => 'dict-chrome-ex',
                'sl' => $from,
                'tl' => $to,
                'dt' => 't',
                'q' => $text,
            ]);

        if ($response->successful()) {
            $json = $response->json();
            if (is_array($json) && isset($json[0]) && is_array($json[0])) {
                $output = '';
                foreach ($json[0] as $segment) {
                    $output .= $segment[0] ?? '';
                }
                $output = trim($output);
                if ($output !== '') {
                    return $output;
                }
            }
        }

        return null;
    }

    /**
     * MyMemory Translated Public API Fallback
     */
    protected static function translateViaMyMemory(string $text, string $from, string $to): ?string
    {
        // MyMemory has a 500-char per request guideline for optimal results
        if (mb_strlen($text) > 500) {
            return self::translateLongTextChunks($text, $from, $to, 'mymemory');
        }

        $url = 'https://api.mymemory.translated.net/get';

        $response = Http::withoutVerifying()
            ->timeout(8)
            ->get($url, [
                'q' => $text,
                'langpair' => "{$from}|{$to}",
            ]);

        if ($response->successful()) {
            $json = $response->json();
            if (isset($json['responseData']['translatedText']) && !empty($json['responseData']['translatedText'])) {
                $result = trim($json['responseData']['translatedText']);
                // Check that response is not an error message
                if (!str_contains($result, 'MYMEMORY WARNING:')) {
                    return $result;
                }
            }
        }

        return null;
    }

    /**
     * Chunker for long HTML or markdown text
     */
    protected static function translateLongTextChunks(string $text, string $from, string $to, string $provider): string
    {
        // Split by double newline or paragraph tags
        $delimiter = str_contains($text, "\n") ? "\n" : (str_contains($text, '</p>') ? '</p>' : '. ');
        $parts = explode($delimiter, $text);
        $translatedParts = [];

        foreach ($parts as $part) {
            $trimmed = trim($part);
            if ($trimmed === '') {
                $translatedParts[] = $part;
                continue;
            }

            if ($provider === 'google') {
                $trans = self::translateViaGoogle($trimmed, $from, $to) ?? $trimmed;
            } else {
                $trans = self::translateViaMyMemory($trimmed, $from, $to) ?? $trimmed;
            }

            $translatedParts[] = $trans;
        }

        return implode($delimiter, $translatedParts);
    }
}


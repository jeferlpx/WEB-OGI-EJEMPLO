<?php

declare(strict_types=1);

/**
 * Polyfill de la extensión PECL fileinfo para entornos PHP donde no está habilitada.
 * Proporciona la clase global finfo, constantes FILEINFO_* y funciones finfo_*.
 */
if (! defined('FILEINFO_NONE')) {
    define('FILEINFO_NONE', 0);
}
if (! defined('FILEINFO_SYMLINK')) {
    define('FILEINFO_SYMLINK', 2);
}
if (! defined('FILEINFO_MIME')) {
    define('FILEINFO_MIME', 1040);
}
if (! defined('FILEINFO_MIME_TYPE')) {
    define('FILEINFO_MIME_TYPE', 16);
}
if (! defined('FILEINFO_MIME_ENCODING')) {
    define('FILEINFO_MIME_ENCODING', 1024);
}
if (! defined('FILEINFO_DEVICES')) {
    define('FILEINFO_DEVICES', 8);
}
if (! defined('FILEINFO_CONTINUE')) {
    define('FILEINFO_CONTINUE', 32);
}
if (! defined('FILEINFO_PRESERVE_ATIME')) {
    define('FILEINFO_PRESERVE_ATIME', 128);
}
if (! defined('FILEINFO_RAW')) {
    define('FILEINFO_RAW', 256);
}
if (! defined('FILEINFO_EXTENSION')) {
    define('FILEINFO_EXTENSION', 2097152);
}

if (! class_exists('finfo')) {
    class finfo
    {
        /**
         * Mapeo de extensiones comunes a MIME types.
         */
        private const EXTENSION_MIME_MAP = [
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xlsm' => 'application/vnd.ms-excel.sheet.macroEnabled.12',
            'xltx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
            'xls' => 'application/vnd.ms-excel',
            'csv' => 'text/csv',
            'tsv' => 'text/tab-separated-values',
            'txt' => 'text/plain',
            'pdf' => 'application/pdf',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'svg' => 'image/svg+xml',
            'ico' => 'image/x-icon',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'zip' => 'application/zip',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'html' => 'text/html',
            'htm' => 'text/html',
            'css' => 'text/css',
            'js' => 'text/javascript',
        ];

        public function __construct(
            private int $flags = FILEINFO_MIME_TYPE,
            private ?string $magicDatabase = null
        ) {}

        public function file(string $filename, int $flags = FILEINFO_NONE, $context = null): string|false
        {
            if (! file_exists($filename) && ! is_file($filename)) {
                return false;
            }

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if ($ext !== '' && isset(self::EXTENSION_MIME_MAP[$ext])) {
                return self::EXTENSION_MIME_MAP[$ext];
            }

            // Detección elemental por primeros bytes del archivo
            $fp = @fopen($filename, 'rb');
            if ($fp) {
                $sample = fread($fp, 512);
                fclose($fp);
                if (is_string($sample) && $sample !== '') {
                    $detected = $this->detectFromBytes($sample);
                    if ($detected !== null) {
                        return $detected;
                    }
                }
            }

            return 'application/octet-stream';
        }

        public function buffer(string $string, int $flags = FILEINFO_NONE, $context = null): string|false
        {
            if ($string === '') {
                return 'application/x-empty';
            }

            $detected = $this->detectFromBytes($string);

            return $detected ?? 'application/octet-stream';
        }

        public function set_flags(int $flags): bool
        {
            $this->flags = $flags;

            return true;
        }

        private function detectFromBytes(string $sample): ?string
        {
            if (str_starts_with($sample, "PK\x03\x04")) {
                return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            }
            if (str_starts_with($sample, '%PDF-')) {
                return 'application/pdf';
            }
            if (str_starts_with($sample, "\x89PNG\r\n\x1a\n")) {
                return 'image/png';
            }
            if (str_starts_with($sample, "\xff\xd8\xff")) {
                return 'image/jpeg';
            }
            if (str_starts_with($sample, 'GIF87a') || str_starts_with($sample, 'GIF89a')) {
                return 'image/gif';
            }
            if (str_starts_with($sample, "\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1")) {
                return 'application/vnd.ms-excel';
            }
            if (mb_check_encoding($sample, 'UTF-8') || mb_check_encoding($sample, 'ISO-8859-1')) {
                return 'text/plain';
            }

            return null;
        }
    }
}

if (! function_exists('finfo_open')) {
    function finfo_open(int $flags = FILEINFO_NONE, ?string $magic_database = null): finfo|false
    {
        return new finfo($flags, $magic_database);
    }
}

if (! function_exists('finfo_close')) {
    function finfo_close(finfo $finfo): bool
    {
        return true;
    }
}

if (! function_exists('finfo_file')) {
    function finfo_file(finfo $finfo, string $filename, int $flags = FILEINFO_NONE, $context = null): string|false
    {
        return $finfo->file($filename, $flags, $context);
    }
}

if (! function_exists('finfo_buffer')) {
    function finfo_buffer(finfo $finfo, string $string, int $flags = FILEINFO_NONE, $context = null): string|false
    {
        return $finfo->buffer($string, $flags, $context);
    }
}

if (! function_exists('finfo_set_flags')) {
    function finfo_set_flags(finfo $finfo, int $flags): bool
    {
        return $finfo->set_flags($flags);
    }
}

if (! function_exists('mime_content_type')) {
    function mime_content_type($filename): string|false
    {
        if (is_string($filename)) {
            $f = new finfo(FILEINFO_MIME_TYPE);

            return $f->file($filename);
        }

        return 'application/octet-stream';
    }
}

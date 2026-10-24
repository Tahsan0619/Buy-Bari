<?php

namespace App\Models;

class CatalogPath
{
    public static function url(?string $path): string
    {
        $path = trim((string) $path);
        if ($path === '') {
            return '/images/logo.png';
        }
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }

        return '/'.ltrim($path, '/');
    }
}

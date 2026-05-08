<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class PublicAssetUrl
{
    public static function toUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $relative = Storage::disk('public')->url($path); // usually "/storage/..." but may be absolute if app.url is set

        // If Storage returned an absolute URL, strip it down to just the path.
        if (str_starts_with($relative, 'http://') || str_starts_with($relative, 'https://')) {
            $relative = parse_url($relative, PHP_URL_PATH) ?: $relative;
        }

        if (!str_starts_with($relative, '/')) {
            $relative = '/' . ltrim($relative, '/');
        }

        // Prefer the live request host (includes port like localhost:8000).
        try {
            $request = request();
            if ($request) {
                $base = $request->getSchemeAndHttpHost(); // e.g. http://localhost:8000
                return rtrim($base, '/') . $relative;
            }
        } catch (\Throwable $e) {
            // Fall back below (e.g. running in console)
        }

        // Fallback to app.url (set this on production).
        $base = rtrim(config('app.url', ''), '/');
        return $base ? ($base . $relative) : url($relative);
    }
}


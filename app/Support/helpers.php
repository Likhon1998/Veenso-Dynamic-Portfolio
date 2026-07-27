<?php

if (! function_exists('media_url')) {
    function media_url(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, '/')) {
            return url(ltrim($path, '/'));
        }

        if (str_starts_with($path, 'storage/')) {
            return url($path);
        }

        return url('storage/'.$path);
    }
}

if (! function_exists('array_to_lines')) {
    function array_to_lines(?array $value): string
    {
        if (empty($value)) {
            return '';
        }

        return implode("\n", $value);
    }
}

if (! function_exists('array_to_json_field')) {
    function array_to_json_field(?array $value): string
    {
        if (empty($value)) {
            return '';
        }

        return json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '';
    }
}

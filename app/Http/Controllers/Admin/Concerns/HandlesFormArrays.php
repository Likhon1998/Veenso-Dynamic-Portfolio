<?php

namespace App\Http\Controllers\Admin\Concerns;

trait HandlesFormArrays
{
    protected function linesToArray(?string $value): ?array
    {
        if ($value === null || trim($value) === '') {
            return null;
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $value))));
    }

    protected function commaToArray(?string $value): ?array
    {
        if ($value === null || trim($value) === '') {
            return null;
        }

        return array_values(array_filter(array_map('trim', explode(',', $value))));
    }

    protected function jsonToArray(?string $value): ?array
    {
        if ($value === null || trim($value) === '') {
            return null;
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : null;
    }

    protected function arrayToLines(?array $value): string
    {
        if (empty($value)) {
            return '';
        }

        return implode("\n", $value);
    }

    protected function arrayToJson(?array $value): string
    {
        if (empty($value)) {
            return '';
        }

        return json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '';
    }
}

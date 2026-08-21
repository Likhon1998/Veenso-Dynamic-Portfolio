<?php

namespace App\Support;

class CaseStudyContent
{
    /**
     * @return array{intro: string, blockers: array<int, string>}
     */
    public static function parseChallenge(?string $text): array
    {
        $text = trim((string) $text);

        if ($text === '') {
            return ['intro' => '', 'blockers' => []];
        }

        $lines = preg_split("/\r\n|\n|\r/", $text) ?: [];
        $intro = [];
        $blockers = [];

        foreach ($lines as $line) {
            $trimmed = trim($line);

            if ($trimmed === '') {
                if ($blockers === []) {
                    $intro[] = '';
                }

                continue;
            }

            if (preg_match('/^(?:[•\-\*]|\d+\.)\s+(.+)$/u', $trimmed, $matches)) {
                $blockers[] = trim($matches[1]);

                continue;
            }

            if ($blockers === []) {
                $intro[] = $trimmed;
            }
        }

        return [
            'intro' => trim(implode("\n\n", array_filter($intro, fn ($line) => $line !== ''))),
            'blockers' => $blockers,
        ];
    }

    /**
     * @return array<int, array{title: string, body: string, icon: string}>
     */
    public static function parseStrategyCards(?string $text): array
    {
        $text = trim((string) $text);

        if ($text === '') {
            return [];
        }

        $icons = ['target', 'search', 'code', 'sparkles', 'brain', 'share'];

        if (! preg_match('/☑|✓/', $text)) {
            return [[
                'title' => 'Strategy',
                'body' => $text,
                'icon' => 'target',
            ]];
        }

        $chunks = preg_split('/(?=☑|✓)/u', $text) ?: [];
        $cards = [];

        foreach ($chunks as $chunk) {
            $chunk = trim($chunk);

            if ($chunk === '') {
                continue;
            }

            $chunk = preg_replace('/^[☑✓]\s*/u', '', $chunk) ?? $chunk;
            $lines = preg_split("/\r\n|\n|\r/", $chunk) ?: [];
            $title = trim((string) array_shift($lines));
            $body = trim(implode("\n", array_map('trim', $lines)));

            if ($title === '') {
                continue;
            }

            $cards[] = [
                'title' => $title,
                'body' => $body,
                'icon' => $icons[count($cards) % count($icons)],
            ];
        }

        return $cards;
    }

    /**
     * @return array{industry: ?string, platform: ?string, location: ?string}
     */
    public static function parseMetaFromExcerpt(?string $excerpt): array
    {
        $excerpt = (string) $excerpt;
        $meta = [
            'industry' => null,
            'platform' => null,
            'location' => null,
        ];

        if (preg_match('/Industry:\s*([^|]+)/i', $excerpt, $matches)) {
            $meta['industry'] = trim($matches[1]);
        }

        if (preg_match('/Platform:\s*([^|]+)/i', $excerpt, $matches)) {
            $meta['platform'] = trim($matches[1]);
        }

        if (preg_match('/Location:\s*([^|]+)/i', $excerpt, $matches)) {
            $meta['location'] = trim($matches[1]);
        }

        return $meta;
    }
}

<?php

namespace App\Console\Commands;

use App\Models\SiteSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SyncFavicons extends Command
{
    protected $signature = 'veenso:sync-favicons';

    protected $description = 'Build square Google-ready favicons from the brand logo in Site Settings.';

    public function handle(): int
    {
        $logoPath = SiteSetting::get('brand_logo');

        if (! $logoPath) {
            $this->error('No brand_logo set in Site Settings. Upload one in Admin → Site Settings first.');

            return self::FAILURE;
        }

        $relative = ltrim(str_replace('storage/', '', $logoPath), '/');
        $absolute = Storage::disk('public')->path($relative);

        if (! is_file($absolute)) {
            $this->error("Brand logo file missing: {$relative}");

            return self::FAILURE;
        }

        $imageInfo = @getimagesize($absolute);
        if (! $imageInfo) {
            $this->error('Brand logo is not a readable image.');

            return self::FAILURE;
        }

        $src = match ($imageInfo['mime'] ?? '') {
            'image/png' => @imagecreatefrompng($absolute),
            'image/jpeg', 'image/jpg' => @imagecreatefromjpeg($absolute),
            'image/webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($absolute) : false,
            default => false,
        };

        if (! $src) {
            $this->error('Could not load brand logo (need PNG/JPEG/WebP with GD).');

            return self::FAILURE;
        }

        $sw = imagesx($src);
        $sh = imagesy($src);

        $targets = [
            48 => public_path('favicon-48x48.png'),
            192 => public_path('favicon-192x192.png'),
            512 => public_path('favicon-512x512.png'),
            180 => public_path('apple-touch-icon.png'),
        ];

        foreach ($targets as $size => $dest) {
            $canvas = imagecreatetruecolor($size, $size);
            imagesavealpha($canvas, true);
            $bg = imagecolorallocate($canvas, 7, 7, 11);
            imagefilledrectangle($canvas, 0, 0, $size, $size, $bg);

            $pad = (int) round($size * 0.14);
            $maxW = $size - ($pad * 2);
            $maxH = $size - ($pad * 2);
            $scale = min($maxW / $sw, $maxH / $sh);
            $dw = max(1, (int) round($sw * $scale));
            $dh = max(1, (int) round($sh * $scale));
            $dx = (int) round(($size - $dw) / 2);
            $dy = (int) round(($size - $dh) / 2);

            imagecopyresampled($canvas, $src, $dx, $dy, 0, 0, $dw, $dh, $sw, $sh);
            imagepng($canvas, $dest);
            imagedestroy($canvas);
            $this->line("Wrote {$dest}");
        }

        imagedestroy($src);

        copy(public_path('favicon-48x48.png'), public_path('favicon.png'));
        // Many crawlers still request /favicon.ico — serve PNG bytes with .ico name is imperfect,
        // so also keep favicon.png and proper link tags in the layout.
        copy(public_path('favicon-48x48.png'), public_path('favicon.ico'));

        $this->info('Favicons synced from brand logo. Hard-refresh the site, then request indexing in Google Search Console.');

        return self::SUCCESS;
    }
}

<?php

namespace App\Console\Commands;

use App\Models\SiteSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SyncFavicons extends Command
{
    protected $signature = 'veenso:sync-favicons';

    protected $description = 'Build square Google-ready favicons from the brand logo mark (icon only).';

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

        imagesavealpha($src, true);
        $sw = imagesx($src);
        $sh = imagesy($src);

        // Wide wordmarks are illegible at 48px — use the left square (icon mark).
        $crop = $this->extractMark($src, $sw, $sh);
        imagedestroy($src);

        $cw = imagesx($crop);
        $ch = imagesy($crop);

        $targets = [
            48 => public_path('favicon-48x48.png'),
            192 => public_path('favicon-192x192.png'),
            512 => public_path('favicon-512x512.png'),
            180 => public_path('apple-touch-icon.png'),
        ];

        foreach ($targets as $size => $dest) {
            $canvas = imagecreatetruecolor($size, $size);
            imagealphablending($canvas, false);
            imagesavealpha($canvas, true);
            $bg = imagecolorallocate($canvas, 7, 7, 11);
            imagefilledrectangle($canvas, 0, 0, $size, $size, $bg);
            imagealphablending($canvas, true);

            // Fill most of the square so the mark stays readable in Google/search tabs.
            $pad = (int) round($size * 0.12);
            $box = $size - ($pad * 2);
            $scale = min($box / $cw, $box / $ch);
            $dw = max(1, (int) round($cw * $scale));
            $dh = max(1, (int) round($ch * $scale));
            $dx = (int) round(($size - $dw) / 2);
            $dy = (int) round(($size - $dh) / 2);

            imagecopyresampled($canvas, $crop, $dx, $dy, 0, 0, $dw, $dh, $cw, $ch);
            imagepng($canvas, $dest, 6);
            imagedestroy($canvas);
            $this->line("Wrote {$dest}");
        }

        imagedestroy($crop);

        copy(public_path('favicon-48x48.png'), public_path('favicon.png'));
        copy(public_path('favicon-48x48.png'), public_path('favicon.ico'));

        $this->info('Favicons synced (icon mark). Google can take several days to update search results.');

        return self::SUCCESS;
    }

    /**
     * @param  \GdImage  $src
     * @return \GdImage
     */
    private function extractMark($src, int $sw, int $sh)
    {
        // Landscape logo: take leftmost square (the V mark), then trim empty margins.
        if ($sw > (int) ($sh * 1.25)) {
            $side = $sh;
            $tmp = imagecreatetruecolor($side, $side);
            imagealphablending($tmp, false);
            imagesavealpha($tmp, true);
            $transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
            imagefilledrectangle($tmp, 0, 0, $side, $side, $transparent);
            imagealphablending($tmp, true);
            imagecopy($tmp, $src, 0, 0, 0, 0, $side, $side);
            $cropped = $this->trimTransparentOrNearBlack($tmp);
            imagedestroy($tmp);

            return $cropped;
        }

        return $this->trimTransparentOrNearBlack($src, cloneSource: true);
    }

    /**
     * @param  \GdImage  $src
     * @return \GdImage
     */
    private function trimTransparentOrNearBlack($src, bool $cloneSource = false)
    {
        $sw = imagesx($src);
        $sh = imagesy($src);

        $minX = $sw;
        $minY = $sh;
        $maxX = 0;
        $maxY = 0;

        for ($y = 0; $y < $sh; $y++) {
            for ($x = 0; $x < $sw; $x++) {
                $rgba = imagecolorat($src, $x, $y);
                $a = ($rgba & 0x7F000000) >> 24;
                $r = ($rgba >> 16) & 0xFF;
                $g = ($rgba >> 8) & 0xFF;
                $b = $rgba & 0xFF;

                // Keep pixels that are visible (not fully transparent / not near-black).
                $isDark = $r < 28 && $g < 28 && $b < 28;
                if ($a < 120 && ! $isDark) {
                    $minX = min($minX, $x);
                    $minY = min($minY, $y);
                    $maxX = max($maxX, $x);
                    $maxY = max($maxY, $y);
                }
            }
        }

        if ($maxX <= $minX || $maxY <= $minY) {
            if ($cloneSource) {
                $copy = imagecreatetruecolor($sw, $sh);
                imagealphablending($copy, false);
                imagesavealpha($copy, true);
                imagecopy($copy, $src, 0, 0, 0, 0, $sw, $sh);

                return $copy;
            }

            $copy = imagecreatetruecolor($sw, $sh);
            imagealphablending($copy, false);
            imagesavealpha($copy, true);
            imagecopy($copy, $src, 0, 0, 0, 0, $sw, $sh);

            return $copy;
        }

        $pad = 2;
        $minX = max(0, $minX - $pad);
        $minY = max(0, $minY - $pad);
        $maxX = min($sw - 1, $maxX + $pad);
        $maxY = min($sh - 1, $maxY + $pad);

        $w = $maxX - $minX + 1;
        $h = $maxY - $minY + 1;
        $side = max($w, $h);

        $out = imagecreatetruecolor($side, $side);
        imagealphablending($out, false);
        imagesavealpha($out, true);
        $transparent = imagecolorallocatealpha($out, 0, 0, 0, 127);
        imagefilledrectangle($out, 0, 0, $side, $side, $transparent);
        imagealphablending($out, true);

        $dx = (int) (($side - $w) / 2);
        $dy = (int) (($side - $h) / 2);
        imagecopy($out, $src, $dx, $dy, $minX, $minY, $w, $h);

        return $out;
    }
}

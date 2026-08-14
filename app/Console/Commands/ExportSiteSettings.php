<?php

namespace App\Console\Commands;

use App\Models\SiteSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ExportSiteSettings extends Command
{
    protected $signature = 'veenso:export-settings';

    protected $description = 'Snapshot current Site Settings (and brand/hero images) so deploys can restore them';

    public function handle(): int
    {
        $rows = SiteSetting::query()
            ->orderBy('id')
            ->get(['key', 'value', 'group'])
            ->toArray();

        $dir = database_path('seeders/data');
        File::ensureDirectoryExists($dir);

        File::put(
            $dir.'/site_settings.json',
            json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        );

        $this->copyMediaToDemoAssets('brand_logo', 'veenso-logo.png');
        $this->copyMediaToDemoAssets('hero_image', 'hero-portrait.png');
        $this->copyMediaToDemoAssets('hero_regions_badge', 'regions-badge.png');

        $this->info('Exported '.count($rows).' site settings to database/seeders/data/site_settings.json');
        $this->info('Commit that file and storage/app/demo-assets so production can seed the same settings.');

        return self::SUCCESS;
    }

    private function copyMediaToDemoAssets(string $settingKey, string $demoFilename): void
    {
        $path = (string) SiteSetting::get($settingKey, '');

        if ($path === '' || ! Storage::disk('public')->exists($path)) {
            return;
        }

        File::ensureDirectoryExists(storage_path('app/demo-assets'));
        File::put(
            storage_path('app/demo-assets/'.$demoFilename),
            Storage::disk('public')->get($path)
        );
    }
}

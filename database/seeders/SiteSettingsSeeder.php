<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $this->installTrackedMedia();

        $path = database_path('seeders/data/site_settings.json');

        if (! is_file($path)) {
            $this->command?->warn('No site_settings.json snapshot found; skipping settings seed.');

            return;
        }

        $rows = json_decode(File::get($path), true) ?: [];

        foreach ($rows as $row) {
            if (empty($row['key'])) {
                continue;
            }

            SiteSetting::query()->firstOrCreate(
                ['key' => $row['key']],
                [
                    'value' => $row['value'] ?? '',
                    'group' => $row['group'] ?? 'general',
                ]
            );
        }
    }

    private function installTrackedMedia(): void
    {
        $copies = [
            storage_path('app/demo-assets/veenso-logo.png') => 'uploads/brand/veenso-logo.png',
            storage_path('app/demo-assets/hero-portrait.png') => 'uploads/hero/portrait.png',
            storage_path('app/demo-assets/hero-portrait.jpg') => 'uploads/hero/portrait.jpg',
            storage_path('app/demo-assets/regions-badge.png') => 'uploads/hero/regions-badge.png',
        ];

        foreach ($copies as $source => $dest) {
            if (! is_file($source) || Storage::disk('public')->exists($dest)) {
                continue;
            }

            Storage::disk('public')->put($dest, file_get_contents($source));
        }
    }
}

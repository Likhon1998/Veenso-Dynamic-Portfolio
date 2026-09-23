<?php

namespace App\Console\Commands;

use App\Models\Service;
use App\Support\SeoServiceContent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RestoreSeoService extends Command
{
    protected $signature = 'veenso:restore-seo-service';

    protected $description = 'Restore SEO (Search Engine Optimization) as service #1 without wiping other services.';

    public function handle(): int
    {
        $featuredImage = $this->installDemoAsset(
            'seo-service-hero.png',
            'uploads/services/seo-service-hero.png'
        ) ?? 'uploads/services/seo-service-hero.png';

        // Make room at sort_order 1 if another service currently owns it.
        Service::query()
            ->where('slug', '!=', 'seo')
            ->where('sort_order', '<=', 1)
            ->increment('sort_order');

        $payload = SeoServiceContent::payload($featuredImage);
        $payload['sort_order'] = 1;
        $payload['is_primary'] = true;
        $payload['status'] = 'published';

        $service = Service::query()->updateOrCreate(
            ['slug' => 'seo'],
            $payload
        );

        $this->info("Restored SEO service #{$service->id} as sort_order {$service->sort_order} (published).");
        $this->line('Public URL: /services/seo');

        return self::SUCCESS;
    }

    private function installDemoAsset(string $filename, string $dest): ?string
    {
        $source = storage_path('app/demo-assets/'.$filename);

        if (! is_file($source)) {
            return null;
        }

        Storage::disk('public')->put($dest, file_get_contents($source));

        return $dest;
    }
}

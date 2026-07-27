@extends('admin.layouts.app')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@section('content')
<div class="card">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="settings-group">
            <h3 class="settings-group-title">Brand & Hero Media</h3>
            <div class="form-grid">
                <div class="form-group">
                    <label for="brand_logo">Brand logo</label>
                    <input type="file" id="brand_logo" name="brand_logo" class="form-control" accept="image/*">
                    @php $logo = $settings->flatten()->firstWhere('key', 'brand_logo'); @endphp
                    @if ($logo?->value)
                        <div class="image-preview"><img src="{{ media_url($logo->value) }}" alt="Brand logo"></div>
                    @endif
                    <span class="hint">Used in the public header and footer.</span>
                </div>
                <div class="form-group">
                    <label for="hero_image">Homepage hero portrait</label>
                    <input type="file" id="hero_image" name="hero_image" class="form-control" accept="image/*">
                    @php $hero = $settings->flatten()->firstWhere('key', 'hero_image'); @endphp
                    @if ($hero?->value)
                        <div class="image-preview"><img src="{{ media_url($hero->value) }}" alt="Hero portrait"></div>
                    @endif
                    <span class="hint">Transparent/cutout portrait for the poster-style hero.</span>
                </div>
                <div class="form-group">
                    <label for="hero_regions_badge">Regions badge image</label>
                    <input type="file" id="hero_regions_badge" name="hero_regions_badge" class="form-control" accept="image/*">
                    @php $badge = $settings->flatten()->firstWhere('key', 'hero_regions_badge'); @endphp
                    @if ($badge?->value)
                        <div class="image-preview"><img src="{{ media_url($badge->value) }}" alt="Regions badge"></div>
                    @endif
                    <span class="hint">Country/flags card shown on the hero poster.</span>
                </div>
            </div>
        </div>

        @foreach ($settings as $group => $groupSettings)
            <div class="settings-group">
                <h3 class="settings-group-title">{{ ucfirst($group) }}</h3>
                <div class="form-grid">
                    @foreach ($groupSettings as $setting)
                        @if (in_array($setting->key, ['brand_logo', 'hero_image', 'hero_banner', 'hero_regions_badge'], true))
                            @continue
                        @endif
                        <div class="form-group">
                            <label for="setting_{{ $setting->key }}">{{ str_replace('_', ' ', ucfirst($setting->key)) }}</label>
                            @if (strlen((string) $setting->value) > 120 || str_contains($setting->key, 'text') || str_contains($setting->key, 'headline') || str_contains($setting->key, 'subtitle') || str_contains($setting->key, 'address') || str_contains($setting->key, 'description'))
                                <textarea id="setting_{{ $setting->key }}" name="settings[{{ $setting->key }}]" class="form-control">{{ old('settings.'.$setting->key, $setting->value) }}</textarea>
                            @else
                                <input type="text" id="setting_{{ $setting->key }}" name="settings[{{ $setting->key }}]" class="form-control" value="{{ old('settings.'.$setting->key, $setting->value) }}">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </div>
    </form>
</div>
@endsection

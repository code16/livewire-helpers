<?php

namespace Code16\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Mechanisms\FrontendAssets\FrontendAssets;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LivewireServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('livewire-helpers')
            ->hasViews()
            ->hasTranslations();
    }

    public function boot(): void
    {
        parent::boot();

        $this->app->booted(function () {
            Blade::directive('livewireScripts', function($expression) {
                return implode("\n", [
                    "{!! view('livewire-helpers::scripts')->render() !!}",
                    FrontendAssets::livewireScripts($expression),
                ]);
            });
        });
    }
}

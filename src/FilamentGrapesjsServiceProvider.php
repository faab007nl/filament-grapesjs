<?php

namespace Ekremogul\FilamentGrapesjs;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentGrapesjsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-grapesjs')
            ->hasRoutes()
            ->hasViews()
            ->hasAssets();
    }

    public function packageBooted(): void
    {
        FilamentAsset::register(array_merge(
            $this->getScripts(),
            $this->getStyles()
        ), 'ekremogul/filament-grapesjs');
    }

    public function getScripts(): array
    {
        return [
            AlpineComponent::make('filament-grapesjs-component', __DIR__ . '/../resources/dist/js/components/filament-grapesjs-component.js'),
        ];
    }
    public function getStyles(): array
    {
        return  [
            Css::make('filament-grapesjs', __DIR__ . '/../resources/dist/css/grapes.css'),
        ];
    }
}

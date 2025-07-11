<?php

declare(strict_types=1);

namespace App\Providers;

use Estivenm0\Admin\MoonShine\Resources\CategoryResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     */
    public function boot(CoreContract $core, ConfiguratorContract $config, ColorManagerContract $colorManager): void
    {

        $this->applyTheme($colorManager);

        $core
            ->resources([])
            ->pages([
                ...$config->getPages(),
            ]);
    }

    public function applyTheme(ColorManagerContract $colorManager): void
    {
        $colorManager->background('#17202a')
            ->content('#1c2833')
            ->tableRow('#212f3c')
            ->borders('#34495e')
            ->buttons('#34495e')
            ->dividers('#5d6d7e')
            ->primary('#0B4C8E')
            ->secondary('#1070B2')
            ->successBg('#117a65')
            ->successText('#82e0aa')
            ->warningBg('#b7950b')
            ->warningText('#f7dc6f')
            ->errorBg('#7b241c')
            ->errorText('#f5b7b1')
            ->infoBg('#21618c')
            ->infoText('#85c1e9');

        $colorManager->successBg('#1e8449')
            ->successBg('#117a65', dark: true)
            ->successText('#82e0aa', dark: true)
            ->warningBg('#b7950b', dark: true)
            ->warningText('#f7dc6f', dark: true)
            ->errorBg('#a93226', dark: true)
            ->errorText('#f5b7b1', dark: true)
            ->infoBg('#21618c', dark: true)
            ->infoText('#85c1e9', dark: true);
    }
}

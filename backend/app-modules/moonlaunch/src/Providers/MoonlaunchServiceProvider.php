<?php

namespace Modules\Moonlaunch\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Moonlaunch\Services\Launch;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;

class MoonlaunchServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Launch::class);
    }

    public function boot(CoreContract $core, Launch $launch): void
    {
        $core
            ->resources($launch->getResources());
    }
}

<?php

namespace Estivenm0\Admin\Providers;

use Estivenm0\Admin\Services\AdminModule;
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;

class AdminServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AdminModule::class);
    }

    public function boot(CoreContract $core, AdminModule $adminModule): void
    {
        $core
            ->resources($adminModule->getResources());
    }
}

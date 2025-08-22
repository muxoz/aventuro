<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Admin\Services\AdminModule;
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

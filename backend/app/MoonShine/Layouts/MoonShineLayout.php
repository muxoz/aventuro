<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Pages\Dashboard;
use Estivenm0\Admin\Services\AdminModule;
use Estivenm0\Moonlaunch\Services\Launch;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\MenuManager\MenuItem;
use MoonShine\UI\Components\Layout\Favicon;
use MoonShine\UI\Components\Layout\Footer;
use MoonShine\UI\Components\Layout\Layout;

final class MoonShineLayout extends AppLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function getFaviconComponent(): Favicon
    {
        return parent::getFaviconComponent()->customAssets([
            'apple-touch' => '/imgs/icon.png',
            '32' => '/imgs/icon.png',
            '16' => '/imgs/icon.png',
            'safari-pinned-tab' => '/imgs/icon.png',
            'web-manifest' => '/imgs/icon.png',
        ]);
    }

    protected function getFooterComponent(): Footer
    {
        return Footer::make()
            ->copyright(
                fn(): string => ''
            )
            ->menu($this->getFooterMenu());
    }


    protected function menu(): array
    {
        return [
            MenuItem::make('Dashboard', Dashboard::class),
            ...app(Launch::class)->getMenu(),
            ...app(AdminModule::class)->getMenu(),

        ];
    }

    /**
     * @param  ColorManager  $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }

    public function build(): Layout
    {
        return parent::build();
    }
}

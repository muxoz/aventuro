<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Package;
use App\Models\User;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Attributes\Icon;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;

#[Icon('s.inbox')]
#[\MoonShine\MenuManager\Attributes\SkipMenu]
class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle(),
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'Dashboard';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        return [
            Grid::make([

                ValueMetric::make('Users')
                    ->value(fn (): int => User::count())
                    ->icon('s.user-group')
                    ->columnSpan(3),

                ValueMetric::make('Packages')
                    ->value(fn (): int => Package::count())
                    ->icon('s.archive-box-arrow-down')
                    ->columnSpan(3),

                ValueMetric::make('Offers')
                    ->value(fn (): int => Offer::count())
                    ->icon('s.ticket')
                    ->columnSpan(3),

                ValueMetric::make('Bookings')
                    ->value(fn (): int => Booking::count())
                    ->icon('s.banknotes')
                    ->columnSpan(3),

                ValueMetric::make('Pending Bookings')
                    ->value(fn (): int => Booking::where('status', 'Pending')->count())
                    ->icon('s.hand-raised')
                    ->columnSpan(3),

                ValueMetric::make('Cancelled Bookings')
                    ->value(fn (): int => Booking::where('status', 'Cancelled')->count())
                    ->icon('nsymbol')
                    ->columnSpan(3),

                ValueMetric::make('Payed Bookings')
                    ->value(fn (): int => Booking::where('status', 'Payed')->count())
                    ->icon('s.banknotes')
                    ->columnSpan(3),

                ValueMetric::make('Categories')
                    ->value(fn (): int => Category::count())
                    ->icon('s.tag')
                    ->columnSpan(3),
            ]),
        ];
    }
}

<?php

declare(strict_types=1);

namespace Modules\Admin\MoonShine\Resources;

use App\Enums\BookingStatus;
use App\Models\Booking;
use Modules\Moonlaunch\Traits\Properties;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\PageType;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\Field;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use Sweet1s\MoonshineRBAC\Traits\WithRolePermissions;

#[Icon('s.banknotes')]
/**
 * @extends ModelResource<Booking>
 */
class BookingResource extends ModelResource
{
    use Properties, WithRolePermissions;

    protected string $model = Booking::class;

    public function __construct()
    {
        $this->title('Bookings')
            ->redirectAfterSave(PageType::INDEX)
            ->columnSelection()
            ->with(['package', 'user'])
            ->editInModal();
    }

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->only(Action::UPDATE);
    }

    public function getBadge(): ?int
    {
        return Booking::where('status', 'Pending')->count();
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('User', resource: CustomerResource::class),
            BelongsTo::make('Package', resource: PackageResource::class),
            Text::make('Status')->badge(fn ($value) => BookingStatus::from($value)->color()),
            Date::make('Travel Date', 'travel_date')->format('d/m/y')->sortable(),
            Number::make('Quantity'),
            Number::make('Total'),
        ];
    }

    public function formFields(): array
    {
        return [
            Flex::make([
                ID::make(),
                Enum::make('Status')
                    ->attach(BookingStatus::class),
                Date::make('Travel Date', 'travel_date'),
            ]),

        ];
    }

    public function search(): array
    {
        return ['id', 'user.name', 'package.title'];
    }

    /**
     * @param  Booking  $item
     * @return array<string, string[]|string>
     *
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(mixed $item): array
    {
        return [
            'status' => ['required', 'in:Pending,Cancelled,Payed'],
        ];
    }
}

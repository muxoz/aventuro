<?php

declare(strict_types=1);

namespace Estivenm0\Admin\MoonShine\Resources;

use App\Models\Offer;
use Estivenm0\Moonlaunch\Traits\Properties;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\DateRange;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use Sweet1s\MoonshineRBAC\Traits\WithRolePermissions;

#[Icon('s.ticket')]
/**
 * @extends ModelResource<Offer>
 */
class OfferResource extends ModelResource
{
    use Properties, WithRolePermissions;

    protected string $model = Offer::class;

    public function __construct()
    {
        $this->title('Offers')
            ->with(['package']);
    }

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->only(Action::CREATE, Action::UPDATE, Action::DELETE, Action::MASS_DELETE);
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Package', 'package', resource: new PackageResource)->searchable(),
            Number::make('Discount', formatted: fn ($item) => $item->discount.' %')->min(5)->max(100),
            DateRange::make('Date')
                ->fromTo('start_date', 'end_date')
                ->format('d/m/Y'),
        ];
    }

    public function formFields(): array
    {
        return [

            ID::make()->sortable(),
            BelongsTo::make('Package', 'package', resource: new PackageResource)->searchable(),
            Number::make('Discount')->min(5)->max(100),
            DateRange::make('Date')
                ->fromTo('start_date', 'end_date')
                ->format('d/m/Y'),
        ];
    }

    public function detailFields(): array
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Package', 'package', resource: new PackageResource)->searchable(),
            Number::make('Discount', formatted: fn ($item) => $item->discount.' %')->min(5)->max(100),
            DateRange::make('Date')
                ->fromTo('start_date', 'end_date')
                ->format('d/m/Y'),
        ];
    }

    /**
     * @param  Offer  $item
     * @return array<string, string[]|string>
     *
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(mixed $item): array
    {
        return [
            'package_id' => 'required|integer|exists:packages,id',
            'discount' => 'required|numeric|min:5|max:100',
            'date.start_date' => 'required|date',
            'date.end_date' => 'required|date|after_or_equal:date.start_date',
        ];
    }
}

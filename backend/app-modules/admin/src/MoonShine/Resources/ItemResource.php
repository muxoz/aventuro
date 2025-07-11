<?php

declare(strict_types=1);

namespace Estivenm0\Admin\MoonShine\Resources;

use App\Models\Item;
use Estivenm0\Moonlaunch\Traits\Properties;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use Sweet1s\MoonshineRBAC\Traits\WithRolePermissions;

/**
 * @extends ModelResource<Item>
 */
class ItemResource extends ModelResource
{
    use Properties, WithRolePermissions;

    protected string $model = Item::class;

    protected string $title = 'Items';

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(Action::VIEW);
    }

    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Package', resource: PackageResource::class),
            Text::make('Name'),
        ];
    }

    public function formFields(): array
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Package', resource: PackageResource::class),
            Text::make('Name'),
        ];
    }

    public function search(): array
    {
        return ['name'];
    }

    /**
     * @param  Item  $item
     * @return array<string, string[]|string>
     *
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(mixed $item): array
    {
        return [
            'name' => 'required|max:200',
        ];
    }
}

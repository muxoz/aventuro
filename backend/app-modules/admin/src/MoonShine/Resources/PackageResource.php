<?php

declare(strict_types=1);

namespace Modules\Admin\MoonShine\Resources;

use App\Models\Package;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\Moonlaunch\Traits\Properties;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\PageType;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Preview;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Sweet1s\MoonshineRBAC\Traits\WithRolePermissions;

#[Icon('s.archive-box-arrow-down')]
/**
 * @extends ModelResource<Package>
 */
class PackageResource extends ModelResource
{
    use Properties, WithRolePermissions;

    protected string $model = Package::class;

    public function __construct()
    {
        $this->title('Packages')
            ->redirectAfterSave(PageType::FORM)
            ->itemsPerPage(10)
            ->stickyTable(false)
            ->columnSelection()
            ->with(['category'])
            ->column('title');
    }

    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Category', resource: CategoryResource::class)->badge('primary'),
            Text::make('Title'),
            Text::make('Destination'),
            Text::make('Duration', formatted: fn ($item) => $item->duration.' days'),
            Text::make('Price'),
            Text::make('Items', 'items_count'),
            Preview::make('Offer', 'offer_count')
                ->boolean(),
        ];
    }

    public function formFields(): array
    {
        return [
            Grid::make([
                Column::make([
                    ID::make()->sortable(),
                    BelongsTo::make('Category', 'category', resource: CategoryResource::class),
                    Image::make('Image')->disk('packages'),
                    Slug::make('Slug')->from('Title')->unique(),
                ])->columnSpan(6),

                Column::make([
                    Text::make('Title'),
                    Text::make('Destination'),
                    Flex::make([
                        Number::make('Duration')->min(5)->max(31)->buttons(),
                        Number::make('Price'),
                    ]),
                ])->columnSpan(6),
            ]),
            Textarea::make('Description'),

            ...$this->relations(),
        ];
    }

    public function detailFields(): array
    {
        return [
            ID::make(),
            BelongsTo::make('Category', resource: CategoryResource::class)->badge('primary'),
            Text::make('Title'),
            Text::make('Destination'),
            Text::make('Duration', formatted: fn ($item) => $item->duration.' days'),
            Text::make('Price'),

            ...$this->relations(),
        ];
    }

    public function relations(): array
    {
        return [
            HasMany::make('Items', 'items', resource: ItemResource::class)
                ->tabMode()
                ->creatable()
                ->searchable(false),

            HasOne::make('Offer', resource: OfferResource::class)
                ->tabMode(),
        ];
    }

    protected function modifyQueryBuilder(Builder $builder): Builder
    {
        return $builder->withCount('items')
            ->withCount(['offer' => function ($query) {
                $query->where('start_date', '<', now())
                    ->where('end_date', '>', now());
            }]);
    }

    public function search(): array
    {
        return ['id', 'title', 'destination'];
    }

    /**
     * @param  Package  $item
     * @return array<string, string[]|string>
     *
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(mixed $item): array
    {
        if (moonshineRequest()->method() == 'PUT') {
            return [
                'category_id' => 'required|integer|exists:categories,id',
                'title' => 'required|string|max:50',
                'slug' => 'required|string|max:255|unique:packages,slug,'.$item->id,
                'description' => 'required|string|max:1000',
                'destination' => 'required|string|max:255',
                'duration' => 'required|integer|max:255',
                'price' => 'required',
                'image' => 'nullable|mimes:jpg,svg,png',
            ];
        }

        return [
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|string|max:50',
            'slug' => 'required|string|max:255|unique:packages,slug',
            'description' => 'required|string|max:1000',
            'destination' => 'required|string|max:255',
            'duration' => 'required|integer|max:255',
            'price' => 'required|integer',
            'image' => 'required|mimes:jpg,svg,png',
        ];
    }
}

<?php

declare(strict_types=1);

namespace Estivenm0\Admin\MoonShine\Resources;

use App\Models\Category;
use Estivenm0\Moonlaunch\Traits\Properties;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Field;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\PageType;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use Sweet1s\MoonshineRBAC\Traits\WithRolePermissions;

#[Icon('s.tag')]
/**
 * @extends ModelResource<Category>
 */
class CategoryResource extends ModelResource
{
    use Properties, WithRolePermissions;

    protected string $model = Category::class;

    public function __construct()
    {
        $this->title('Categories')
            ->redirectAfterSave(PageType::INDEX)
            ->itemsPerPage(15)
            ->column('name')
            ->allInModal();
    }

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->only(Action::CREATE, Action::UPDATE);
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Name'),
            Text::make('Description'),
        ];
    }

    public function formFields(): iterable
    {
        return [
            Flex::make([
                ID::make(),
                Text::make('Name')->required(),
                Text::make('Description')->required(),
            ]),
        ];
    }

    public function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Name'),
            Text::make('Description'),
        ];
    }

    public function search(): array
    {
        return ['id', 'name'];
    }

    /**
     * @param  Category  $item
     * @return array<string, string[]|string>
     *
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(mixed $item): array
    {
        return [
            'name' => moonshineRequest()->isMethod('post')
                ? 'required|string|unique:categories,name'
                : 'required|string|unique:categories,name,'.$item->id,
            'description' => 'required|string|max:250',
        ];
    }
}

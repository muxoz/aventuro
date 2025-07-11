<?php

declare(strict_types=1);

namespace Estivenm0\Admin\MoonShine\Resources;

use App\Models\User;
use Estivenm0\Moonlaunch\Traits\Properties;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Text;
use Sweet1s\MoonshineRBAC\Traits\WithRolePermissions;

#[Icon('s.user-circle')]
/**
 * @extends ModelResource<User>
 */
class CustomerResource extends ModelResource
{
    use Properties, WithRolePermissions;

    protected string $model = User::class;

    public function __construct()
    {
        $this->title('Customers')
            ->columnSelection()
            ->column('name');
    }

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->only(Action::VIEW);
    }

    protected function modifyQueryBuilder(Builder $builder): Builder
    {
        return $builder->whereDoesntHave('roles');
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Name'),
            Email::make('Email'),
            Phone::make('Phone'),
            Text::make('Address'),
            HasMany::make('Bookings', resource: BookingResource::class)
                ->relatedLink('user'),
        ];
    }

    public function DetailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Name'),
            Email::make('Email'),
            Phone::make('Phone'),
            Text::make('Address'),
            HasMany::make('Bookings', 'bookings', resource: BookingResource::class),
        ];
    }

    public function search(): array
    {
        return ['id', 'name', 'email'];
    }

    /**
     * @param  User  $item
     * @return array<string, string[]|string>
     *
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    // public function rules(Model $item): array
    // {
    //     return [];
    // }
}

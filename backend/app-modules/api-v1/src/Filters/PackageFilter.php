<?php

namespace Modules\ApiV1\Filters;

class PackageFilter extends ApiFilters
{
    protected array $safeParams = [
        'title' => ['eq'],
        'price' => ['eq', 'lt', 'gt'],
        'destination' => ['eq'],
        'duration' => ['eq', 'gt', 'lt'],
        'categoryId' => ['eq'],
    ];

    protected array $columnMap = [
        'categoryId' => 'category_id',
    ];
}

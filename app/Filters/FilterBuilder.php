<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class FilterBuilder
{
    const FILTERS_NAMESPACE = 'App\Filters\\';

    public function __construct(
        private Builder $query,
        protected array $filters,
        protected string $filterName
    ) {}

    /**
     * Метод создает экземпляры переданных ему фильтров и применяет их к запросу
     *
     * @return Builder
     */
    public function apply(): Builder
    {
        foreach ($this->filters as $name => $value) {
            $class = self::FILTERS_NAMESPACE . ucfirst($this->filterName) . "Filters\\" . ucfirst(Str::camel($name));

            if (! class_exists($class)) {
                continue;
            }

            if (! empty($value)) {
                (new $class($this->query))->handle($value);
            }
        }
        return $this->query;
    }
}

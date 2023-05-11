<?php

namespace App\Filters\ComplexFilters;

use App\Filters\BaseFilter;
use App\Filters\FilterInterface;
use App\Models\Apartment;

class PriceFrom extends BaseFilter implements FilterInterface
{
    /**
     * Цена квартиры от...
     * ЖК, в которых есть квартиры, стоимость которых больше указанной в фильтре
     *
     * @param $value
     * @return void
     */
    public function handle($value): void
    {
        $this->query->where(Apartment::selectRaw('max(price)')
            ->whereColumn('complex_id', 'complex.complex_id'), '>', str_replace(' ','', $value));
    }
}

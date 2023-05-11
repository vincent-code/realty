<?php

namespace App\Filters\ComplexFilters;

use App\Filters\BaseFilter;
use App\Filters\FilterInterface;
use App\Models\Apartment;

class PriceTo extends BaseFilter implements FilterInterface
{
    /**
     * Цена квартиры до...
     * ЖК, в которых есть квартиры, стоимость которых меньше указанной в фильтре
     *
     * @param $value
     * @return void
     */
    public function handle($value): void
    {
        $this->query->where(Apartment::selectRaw('min(price)')
            ->whereColumn('complex_id', 'complex.complex_id'), '<', str_replace(' ','', $value));
    }
}

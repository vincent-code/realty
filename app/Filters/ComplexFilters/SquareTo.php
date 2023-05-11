<?php

namespace App\Filters\ComplexFilters;

use App\Filters\BaseFilter;
use App\Filters\FilterInterface;
use App\Models\Apartment;

class SquareTo extends BaseFilter implements FilterInterface
{
    /**
     * Площадь квартиры до...
     * ЖК, в которых есть квартиры, площадь которых меньше указанной в фильтре
     *
     * @param $value
     * @return void
     */
    public function handle($value): void
    {
        $this->query->where(Apartment::selectRaw('min(square)')
            ->whereColumn('complex_id', 'complex.complex_id'), '<', $value);
    }
}

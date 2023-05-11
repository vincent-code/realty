<?php

namespace App\Filters\ComplexFilters;

use App\Filters\BaseFilter;
use App\Filters\FilterInterface;
use App\Models\Apartment;

class SquareFrom extends BaseFilter implements FilterInterface
{
    /**
     * Площадь квартиры от...
     * ЖК, в которых есть квартиры, площадь которых больше указанной в фильтре
     *
     * @param $value
     * @return void
     */
    public function handle($value): void
    {
        $this->query->where(Apartment::selectRaw('max(square)')
            ->whereColumn('complex_id', 'complex.complex_id'), '>', $value);
    }
}

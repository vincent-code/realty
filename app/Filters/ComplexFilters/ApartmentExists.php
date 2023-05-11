<?php

namespace App\Filters\ComplexFilters;

use App\Filters\BaseFilter;
use App\Filters\FilterInterface;
use App\Models\Apartment;
use App\Repository\ApartmentTypeRepositoryInterface;

class ApartmentExists extends BaseFilter implements FilterInterface
{
    /**
     * ЖК, в которых есть минимум один из указанных типов квартир
     *
     * @param $types
     * @return void
     */
    public function handle($types): void
    {
        $apartmentTypeRepository = app(ApartmentTypeRepositoryInterface::class);

        if (in_array(3, $types)) {
            // если в фильтре по типам квартир присутсвует значение '3+'
            // добавляем остальные типы квартир
            array_push($types, ...$apartmentTypeRepository::OTHER_TYPES);
        }

        $this->query->where(function ($query) use ($types) {

            $query->where((Apartment::selectRaw('count(*)')
                ->whereColumn('complex_id', 'complex.complex_id')
                ->where(function ($query) use ($types) {
                    $query->where('apartment_type_id', $types[0]);
                })), '>', 0);

                if (count($types) > 1) {
                    unset($types[0]);
                    foreach ($types as $type) {
                        $query->orWhere((Apartment::selectRaw('count(*)')
                            ->whereColumn('complex_id', 'complex.complex_id')
                            ->where(function ($query) use ($type) {
                                $query->where('apartment_type_id', $type);
                            })), '>', 0);
                    }
                }
        });
    }
}

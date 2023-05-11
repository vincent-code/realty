<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Repository\ApartmentTypeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\ApartmentType;
use Illuminate\Support\Facades\Cache;

class ApartmentTypeRepository extends BaseRepository implements ApartmentTypeRepositoryInterface
{
    /**
     * Основные типы квартир для отображения в карточке ЖК: 1,2,3-комн и студии(8)
     */
    const BASE_TYPES = [1, 2, 3, 8];

    /**
     * Остальные типы квартир 4,5-комн и свободная планировка(9)
     */
    const OTHER_TYPES = [4, 5, 9];

    public function __construct(ApartmentType $model)
    {
        parent::__construct($model);
    }

    /**
     * Основные типы квартир
     *
     * @return Collection
     */
    public function getBaseType(): Collection
    {
        return Cache::remember('apartment_base_type', 86400, function () {
            $apartmentTypes = $this->model::select('id', 'apartment_type_id AS type_id', 'name')
                ->whereIn('apartment_type_id', self::BASE_TYPES)
                ->orderBy('apartment_type_id', 'asc')
                ->get();
            return $apartmentTypes->prepend($apartmentTypes->pop());
        });
    }
}

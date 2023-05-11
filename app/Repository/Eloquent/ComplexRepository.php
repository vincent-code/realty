<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Apartment;
use App\Models\Complex;
use App\Models\Developer;
use App\Models\Region;
use App\Repository\ComplexRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class ComplexRepository extends BaseRepository implements ComplexRepositoryInterface
{

    public function __construct(Complex $model)
    {
        parent::__construct($model);
    }

    /**
     * Карточка ЖК
     *
     * @param Collection $apartmentTypes
     * @return Builder
     */
    public function card(Collection $apartmentTypes): Builder
    {
        $query = $this->model::select('complex_id', 'name', 'address', 'image', 'apartment_count')
            ->addSelect([
                'developer' => Developer::select('name')->whereColumn('developer_id', 'complex.developer_id')
            ]);

        foreach ($apartmentTypes as $item) {
            $type = ($item->type_id == 8) ? 'studio' : $item->type_id;
            //находим минимальную стоимость для каждого типа квартиры
            $query->addSelect([
                "min_price_$type" =>
                    Apartment::selectRaw('min(price)')
                        ->whereColumn('complex_id', 'complex.complex_id')
                        ->where(function ($query) use ($item) {
                            $query->where('apartment_type_id', $item->type_id);
                        })
            ]);

            //находим минимальную площадь для каждого типа квартиры
            $query->addSelect([
                "min_square_$type" =>
                    Apartment::selectRaw('min(square)')
                        ->whereColumn('complex_id', 'complex.complex_id')
                        ->where(function ($query) use ($item) {
                            $query->where('apartment_type_id', $item->type_id);
                        })
            ]);
        }

        return $query->whereNotNull('apartment_count')
            ->orderBy('apartment_count', 'desc');
    }

    /**
     * Все ЖК
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Cache::remember('complexes_all', 86400, function () {
            return $this->model::select('complex_id', 'name')
                ->whereNotNull('apartment_count')
                ->get();
        });
    }

    /**
     * Получаем ЖК по id
     *
     * @param string $id
     * @return Complex
     */
    public function getById(string $id): Complex
    {
        return $this->model::select('complex_id', 'name', 'address', 'description', 'coordinates', 'image')
            ->addSelect([
                'region' => Region::select('name')->whereColumn('region_id', 'complex.region_id'),
                'developer' => Developer::select('name')->whereColumn('developer_id', 'complex.developer_id')
            ])
            ->where('complex_id', $id)
            ->get()
            ->first();
    }
}

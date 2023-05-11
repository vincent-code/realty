<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Apartment;
use App\Models\Building;
use App\Repository\ApartmentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\ApartmentType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class ApartmentRepository extends BaseRepository implements ApartmentRepositoryInterface
{
    public function __construct(Apartment $model)
    {
        parent::__construct($model);
    }

    /**
     * Все квартиры для ЖК
     *
     * @param string $id
     * @return LengthAwarePaginator
     */
    public function getByComplexId(string $id): LengthAwarePaginator
    {
        return $this->model::select('price', 'square', 'floor', 'floors', 'plan')
            ->addSelect([
                'apartment_type' => ApartmentType::select('name')
                    ->whereColumn('apartment_type_id', 'apartment.apartment_type_id'),
                'building_name' => Building::select('name')
                    ->whereColumn('building_id', 'apartment.building_id'),
                'building_queue' => Building::select('queue')
                    ->whereColumn('building_id', 'apartment.building_id')
            ])
            ->where('complex_id', $id)
            ->paginate(20);
    }

    /**
     * Общее кол-во квартир
     *
     * @return int|string
     */
    public function getCount(): int|string
    {
        return Cache::remember('apartment_count', 86400, function () {
            return $this->model::count();
        });
    }

    /**
     * Дата обновления
     *
     * @return Carbon
     */
    public function getUpd(): Carbon
    {
        return Cache::remember('database_update', 86400, function () {
            return $this->model::first()->updated_at;
        });
    }
}

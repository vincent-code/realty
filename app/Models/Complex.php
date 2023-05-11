<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\FilterBuilder;

class Complex extends Model
{
    use HasFactory;

    protected $table = 'complex';
    const COMPLEXES_PER_PAGE = 20;

    /**
     * Литеры ЖК
     *
     * @return HasMany
     */
    public function buildings(): HasMany
    {
        return $this->hasMany(Building::class);
    }

    /**
     * Квартиры ЖК
     *
     * @return HasMany
     */
    public function apartments(): HasMany
    {
        return $this->hasMany(Apartment::class, 'complex_id', 'complex_id');
    }

    /**
     * Фильтр ЖК
     *
     * @param Builder $query
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function scopeFilter(Builder $query, array $params): LengthAwarePaginator
    {
        return (new FilterBuilder($query, $params, $this->table))->apply()
            ->paginate(self::COMPLEXES_PER_PAGE);
    }

    /**
     * Избранное
     *
     * @param Builder $query
     * @param array $favoriteIds
     * @return LengthAwarePaginator
     */
    public function scopeFavorite(Builder $query, array $favoriteIds): LengthAwarePaginator
    {
        return $query->whereIn('complex_id', $favoriteIds)
            ->paginate(self::COMPLEXES_PER_PAGE);
    }

    /**
     * Количество найденных ЖК по параметрам фильтра
     *
     * @param Builder $query
     * @param array $params
     * @return int
     */
    public function scopeFilterCount(Builder $query, array $params): int
    {
        return (new FilterBuilder($query, $params, $this->table))->apply()
            ->whereNotNull('apartment_count')
            ->count();
    }
}

<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Repository\DeveloperRepositoryInterface;
use App\Models\Developer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class DeveloperRepository extends BaseRepository implements DeveloperRepositoryInterface
{
    public function __construct(Developer $model)
    {
        parent::__construct($model);
    }

    /**
     * Все застройщики
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Cache::remember('developers_all', 86400, function () {
            return $this->model::select('developer_id', 'name')->get();
        });
    }
}

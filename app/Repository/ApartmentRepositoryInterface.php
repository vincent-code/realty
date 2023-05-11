<?php

namespace App\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

interface ApartmentRepositoryInterface
{
    public function getByComplexId(string $id): LengthAwarePaginator;
    public function getCount(): int|string;
    public function getUpd(): Carbon;
}

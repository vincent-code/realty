<?php

namespace App\Repository;

use App\Models\Complex;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

interface ComplexRepositoryInterface
{
    public function card(Collection $apartmentTypes): Builder;
    public function getAll(): Collection;
    public function getById(string $id): Complex;
}

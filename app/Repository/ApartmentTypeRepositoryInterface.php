<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;

interface ApartmentTypeRepositoryInterface
{
    public function getBaseType(): Collection;
}

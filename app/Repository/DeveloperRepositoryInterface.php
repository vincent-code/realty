<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;

interface DeveloperRepositoryInterface
{
    public function getAll(): Collection;
}

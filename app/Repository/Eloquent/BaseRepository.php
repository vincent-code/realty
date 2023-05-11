<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    public function __construct(
        protected Model $model
    ) {}

    public function model(): Model
    {
        return $this->model;
    }
}

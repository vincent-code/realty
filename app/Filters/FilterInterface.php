<?php

namespace App\Filters;

interface FilterInterface
{
    public function handle(mixed $value): void;
}

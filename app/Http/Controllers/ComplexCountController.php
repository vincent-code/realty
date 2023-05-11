<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\ComplexRepositoryInterface;
use App\Services\FilterService;

class ComplexCountController extends Controller
{
    public function __construct(
        private ComplexRepositoryInterface $complexRepository,
        private FilterService $filterService
    ) {}

    /**
     * Количество найденных ЖК по параметрам фильра
     *
     * @return int
     */
    public function __invoke(): int
    {
        return $this->complexRepository->model()
            ->filterCount($this->filterService->checkParams());
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\ComplexRepositoryInterface;
use App\Repository\DeveloperRepositoryInterface;
use App\Repository\ApartmentTypeRepositoryInterface;
use App\Services\FilterService;
use App\Services\FavoriteService;
use Illuminate\Contracts\View\View;

class ComplexController extends Controller
{
    public function __construct(
        private ComplexRepositoryInterface $complexRepository,
        private DeveloperRepositoryInterface $developerRepository,
        private ApartmentTypeRepositoryInterface $apartmentTypeRepository,
        private FilterService $filterService
    ) {}

    /**
     * Страница с карточками ЖК
     *
     * @return View
     */
    public function __invoke(): View
    {
        $filters = $this->filterService->getFilter(); // параметры фильтра
        $apartmentTypes = $this->apartmentTypeRepository->getBaseType(); // основные типы квартир для карточки ЖК

        return view('complexes.complexes', [
            'complexes' => $this->complexRepository->card($apartmentTypes)->filter($filters), // карточки ЖК
            'apartmentTypes' => $apartmentTypes,
            'complexesForFilter' => json_encode($this->complexRepository->getAll(), JSON_UNESCAPED_UNICODE),
            'developersForFilter' => json_encode($this->developerRepository->getAll()),
            'filters' => $filters,
            'favoriteIds' => FavoriteService::getFavoriteIds() // id избранных ЖК
        ]);
    }
}

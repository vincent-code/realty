<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\ApartmentTypeRepositoryInterface;
use App\Repository\ComplexRepositoryInterface;
use App\Services\FavoriteService;
use Illuminate\Contracts\View\View;

class FavoriteController extends Controller
{
    public function __construct(
        private ComplexRepositoryInterface $complexRepository,
        private ApartmentTypeRepositoryInterface $apartmentTypeRepository
    ) {}

    /**
     * Страница с избранными ЖК
     *
     * @return View
     */
    public function __invoke(): View
    {
        if (! $favoriteIds = FavoriteService::getFavoriteIds()) {
            return view('favorite.favorite-empty');
        }

        $apartmentTypes = $this->apartmentTypeRepository->getBaseType();

        return view('favorite.favorite', [
            'complexes' => $this->complexRepository->card($apartmentTypes)->favorite($favoriteIds),
            'favoriteIds' => $favoriteIds,
            'apartmentTypes' => $apartmentTypes
        ]);
    }
}

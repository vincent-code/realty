<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\ComplexRepositoryInterface;
use App\Repository\ApartmentRepositoryInterface;
use App\Services\FavoriteService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ComplexDetailController extends Controller
{
    public function __construct(
        private ComplexRepositoryInterface $complexRepository,
        private ApartmentRepositoryInterface $apartmentRepository,
        private Request $request
    ) {
        view()->share('complex', $this->complexRepository->getById($this->request->id));
    }

    /**
     * Детальная страница ЖК - описание ЖК
     *
     * @return View
     */
    public function description(): View
    {
        return view('complex_detail.description', [
            'isFavorite' => FavoriteService::checkFavorite($this->request->id)
        ]);
    }

    /**
     * Детальная страница ЖК - квартиры ЖК
     *
     * @param string $id
     * @return View
     */
    public function apartments(string $id): View
    {
        return view('complex_detail.apartments', [
            'apartments' => $this->apartmentRepository->getByComplexId($id),
            'isFavorite' => FavoriteService::checkFavorite($this->request->id)
        ]);
    }
}

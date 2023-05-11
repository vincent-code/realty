<?php

namespace App\View\Components;

use App\Repository\ApartmentRepositoryInterface;
use App\Repository\ComplexRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DatabaseInfo extends Component
{
    public function __construct(
        private ComplexRepositoryInterface $complexRepository,
        private ApartmentRepositoryInterface $apartmentRepository
    ) {}

    /**
     * Компонент, отображающий информацию о базе данных (кол-во ЖК и квартир, дата обновления)
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.database-info', [
            'complexes' => $this->complexRepository->getAll()->count(),
            'apartmentsCount' => $this->apartmentRepository->getCount(),
            'updatedAt' => $this->apartmentRepository->getUpd()
        ]);
    }
}

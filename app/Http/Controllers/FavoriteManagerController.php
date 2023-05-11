<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\FavoriteService;

class FavoriteManagerController extends Controller
{
    public function __construct(
        private FavoriteService $favoriteService
    ) {}

    /**
     * Добавляем ЖК в избранное
     *
     * @return int
     */
    public function add(): int
    {
        return $this->favoriteService->add();
    }

    /**
     * Удаляем ЖК из избранного
     *
     * @return int|null
     */
    public function remove(): ?int
    {
        return $this->favoriteService->remove();
    }
}

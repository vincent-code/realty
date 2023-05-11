<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;

class FavoriteService
{
    private string $complexId;

    public function __construct(
        private Request $request
    ) {
        $this->complexId = $this->request->input('id');
    }

    /**
     * Добавляем ЖК в избранное
     *
     * @return int
     */
    public function add(): int
    {
        if ($this->request->session()->has('favorite')) {
            $this->request->session()->push('favorite', $this->complexId);
        } else {
            $this->request->session()->put('favorite', [$this->complexId]);
        }
        return count($this->request->session()->get('favorite'));
    }

    /**
     * Удаляем ЖК из избранного
     *
     * @return int|null
     */
    public function remove(): ?int
    {
        $favorite = $this->request->session()->get('favorite');

        if (($key = array_search($this->complexId, $favorite)) !== false) {
            unset($favorite[$key]);
        }

        if (!empty($favorite)) {
            $this->request->session()->put('favorite', $favorite);
            return count($this->request->session()->get('favorite'));
        } else {
            $this->request->session()->forget('favorite');
            return null;
        }
    }

    /**
     * Получаем избранное из сессии
     *
     * @return array|null
     */
    public static function getFavoriteIds(): ?array
    {
        return session('favorite') ?? null;
    }


    /**
     * Проверяем находится ли ЖК в избранном
     *
     * @param string $complexId
     * @return bool
     */
    public static function checkFavorite(string $complexId): bool
    {
        $favoriteIds = self::getFavoriteIds();
        return !is_null($favoriteIds) && in_array($complexId, $favoriteIds);
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;

class FilterService
{
    public function __construct(
        private Request $request
    ) {}

    /**
     * Получаем набор фильтров из запроса или из сессии
     *
     * @return array
     */
    public function getFilter(): array
    {
        $filters = [];
        if ($this->request->isMethod('post')) {

            if ($filters = $this->checkParams()) {
                $this->request->session()->put('complex_filter', $filters);
            } else {
                $this->request->session()->forget('complex_filter');
            }

        } else if ($this->request->session()->has('complex_filter')) {
            $filters = $this->request->session()->get('complex_filter');
        }
        return $filters;
    }

    /**
     * Убираем фильтры с пустыми значениями
     *
     * @param array|null $params
     * @return array
     */
    public function checkParams(): array
    {
        return array_filter(
            $this->request->except('_token'),
            function ($val) {
                if (is_array($val)) {
                    return array_filter($val, fn ($val) => ! empty($val));
                } else {
                    return ! empty($val);
                }
            });
    }
}

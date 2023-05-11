<?php

namespace App\Filters\ComplexFilters;

use App\Filters\BaseFilter;
use App\Filters\FilterInterface;

class ComplexOrDeveloper extends BaseFilter implements FilterInterface
{
    /**
     * ЖК, выбранные по их названию или по названию их застройщика
     *
     * @param $value
     * @return void
     */
    public function handle($value): void
    {
        if (isset($value['complex_id']) && isset($value['developer_id'])) {
            // если в фильтре указаны названия ЖК и названия застройщиков
            // выбираем ЖК по совпадению с одним из параметров
            $this->query->where(function ($query) use ($value) {
                $query->whereIn('complex_id', explode(',', $value['complex_id']))
                    ->orWhereIn('developer_id', explode(',', $value['developer_id']));
            });

        } else if (isset($value['complex_id'])) {

            $this->query->whereIn('complex_id', explode(',', $value['complex_id']));

        } else if (isset($value['developer_id'])) {

            $this->query->whereIn('developer_id', explode(',', $value['developer_id']));

        }
    }
}

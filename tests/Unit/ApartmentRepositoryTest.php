<?php

namespace Tests\Unit;

use App\Models\Apartment;
use App\Repository\ApartmentRepositoryInterface;
use App\Repository\ComplexRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class ApartmentRepositoryTest extends TestCase
{
    public function test_get_by_complex_id()
    {
        $complexRepository = resolve(ComplexRepositoryInterface::class);
        $apartmentRepository = resolve(ApartmentRepositoryInterface::class);

        $complexId = $complexRepository->model()->whereNotNull('apartment_count')->first()->complex_id;
        $apartments = $apartmentRepository->getByComplexId($complexId);

        $this->assertInstanceOf(LengthAwarePaginator::class, $apartments);
        $this->assertInstanceOf(Apartment::class, $apartments[0]);
    }
}

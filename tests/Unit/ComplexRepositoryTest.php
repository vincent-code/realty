<?php

namespace Tests\Unit;

use App\Models\Complex;
use App\Repository\ApartmentTypeRepositoryInterface;
use App\Repository\ComplexRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class ComplexRepositoryTest extends TestCase
{
    public function test_card()
    {
        $card = $this->complexRepository->card($this->apartmentTypes);

        $this->assertInstanceOf(Builder::class, $card);
    }

    public function test_complex_filter()
    {
        $complexes = $this->complexRepository->card($this->apartmentTypes)->filter($this->filters);

        $this->assertInstanceOf(LengthAwarePaginator::class, $complexes);
        $this->assertInstanceOf(Complex::class, $complexes[0]);
    }

    public function test_get_by_id()
    {
        $complexId = $this->complexRepository->model()->whereNotNull('apartment_count')->first()->complex_id;
        $complex = $this->complexRepository->getById($complexId);

        $this->assertInstanceOf(Complex::class, $complex);
        $this->assertEquals($complex->complex_id, $complexId);
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->complexRepository = resolve(ComplexRepositoryInterface::class);
        $apartmentTypeRepository = resolve(ApartmentTypeRepositoryInterface::class);
        $this->apartmentTypes = $apartmentTypeRepository->getBaseType();

        $this->filters = [
            "apartment_exists" => [
                0 => "1",
                1 => "2"
            ],
            "square_from" => "20",
            "square_to" => "40",
            "price_from" => "2 000 000",
            "price_to" => "5 500 000"
        ];
    }

    protected function tearDown(): void
    {
        $this->complexRepository = null;
        $this->apartmentTypes = null;
        $this->filters = null;
    }
}

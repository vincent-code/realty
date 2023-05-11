<?php

namespace Tests\Feature;

use App\Repository\ApartmentRepositoryInterface;
use App\Repository\ComplexRepositoryInterface;
use Tests\TestCase;

class ComplexDetailControllerTest extends TestCase
{
    private $complex;

    public function test_description_method()
    {
        $response = $this->get('/complexes/' . $this->complex->complex_id);

        $response->assertStatus(200);
        $response->assertViewHas('complex', $this->complex);
        $response->assertSee($this->complex->name);
    }

    public function test_apartments_method()
    {
        $apartmentRepository = resolve(ApartmentRepositoryInterface::class);
        $apartments = $apartmentRepository->getByComplexId($this->complex->complex_id);

        $response = $this->get('/complexes/' . $this->complex->complex_id . '/apartments');

        $response->assertStatus(200);
        $response->assertViewHas('complex', $this->complex);
        $response->assertSee($this->complex->name);
    }

    public function setUp(): void
    {
        parent::setUp();

        $complexRepository = resolve(ComplexRepositoryInterface::class);
        $complexId = $complexRepository->model()->whereNotNull('apartment_count')->first()->complex_id;
        $this->complex = $complexRepository->getById($complexId);
    }

    protected function tearDown(): void
    {
        $this->complex = null;
    }
}

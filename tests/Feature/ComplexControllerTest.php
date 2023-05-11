<?php

namespace Tests\Feature;

use App\Repository\ComplexRepositoryInterface;
use App\Repository\ApartmentTypeRepositoryInterface;
use Tests\TestCase;

class ComplexControllerTest extends TestCase
{
    public function test_complexes_get()
    {
        $response = $this->get('/complexes');

        $response->assertStatus(200);
        $response->assertViewHas('apartmentTypes', $this->apartmentTypes);
    }

    public function test_complexes_post()
    {
        $complex = $this->complexRepository->model()->whereNotNull('apartment_count')->first();

        $filter = [
            'complex_or_developer' => [
                'complex_id' => $complex->complex_id,
                'developer_id' => null
            ]
        ];
        $complexes = $this->complexRepository->card($this->apartmentTypes)->filter($filter);

        $response = $this->post('/complexes', $filter);

        $response->assertStatus(200);
        $response->assertViewHas('apartmentTypes', $this->apartmentTypes);
        $response->assertSessionHas('complex_filter', $filter);
        $response->assertSee($complexes[0]->name);
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->complexRepository = resolve(ComplexRepositoryInterface::class);
        $apartmentTypeRepository = resolve(ApartmentTypeRepositoryInterface::class);
        $this->apartmentTypes = $apartmentTypeRepository->getBaseType();
    }

    protected function tearDown(): void
    {
        $this->complexRepository = null;
        $this->apartmentTypes = null;
    }
}

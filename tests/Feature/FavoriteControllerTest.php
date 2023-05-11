<?php

namespace Tests\Feature;

use App\Repository\ComplexRepositoryInterface;
use App\Repository\ApartmentTypeRepositoryInterface;
use Tests\TestCase;

class FavoriteControllerTest extends TestCase
{
    public function test_favorite_empty_get()
    {
        $response = $this->get('/favorite');

        $response->assertStatus(200);
        $response->assertSee('Добавьте ЖК');
    }

    public function test_favorite_not_empty_get()
    {
        $complexes = $this->complexRepository->model()->whereNotNull('apartment_count')->take(2)->get();

        $favoriteIds = [$complexes[0]->complex_id, $complexes[1]->complex_id];

        $complexes = $this->complexRepository->card($this->apartmentTypes)->favorite($favoriteIds);

        $response = $this->withSession(['favorite' => $favoriteIds])->get('/favorite');

        $response->assertStatus(200);
        $response->assertSee($complexes[0]->name);
        $response->assertSee($complexes[1]->name);
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

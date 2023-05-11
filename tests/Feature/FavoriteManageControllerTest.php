<?php

namespace Tests\Feature;

use App\Repository\ComplexRepositoryInterface;
use Tests\TestCase;

class FavoriteManageControllerTest extends TestCase
{
    public function test_add_method()
    {
        $complexId = $this->complexRepository->model()->whereNotNull('apartment_count')->first()->complex_id;
        $postData = ['id' => $complexId];

        $response = $this->post('/favorite/add', $postData);

        $response->assertStatus(200);
        $response->assertSessionHas('favorite', [$complexId]);
    }

    public function test_remove_method()
    {
        $complexes = $this->complexRepository->model()->whereNotNull('apartment_count')->take(2)->get();

        $id1 = $complexes[0]->complex_id;
        $id2 = $complexes[1]->complex_id;
        $postData = ['id' => $id2];

        $response = $this->withSession(['favorite' => [$id1, $id2]])
            ->post('/favorite/remove', $postData);

        $response->assertStatus(200);
        $response->assertSessionHas('favorite', [$id1]);
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->complexRepository = resolve(ComplexRepositoryInterface::class);
    }

    protected function tearDown(): void
    {
        $this->complexRepository = null;
    }
}

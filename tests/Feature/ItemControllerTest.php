<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Enums\StatusEnum;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private array $itemData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->itemData = [
            'title' => $this->faker->sentence,
            'status' => StatusEnum::Pending,
        ];
    }

    public function testIndexReturnsCorrectNumberOfItems()
    {
        Item::factory()->count(3)->create();

        $response = $this->getJson('/api/items');

        $response->assertOk()
                 ->assertJsonCount(3, 'data');
    }

    public function testStorePersistsNewItemAndReturnsCorrectJsonResponse()
    {
        $response = $this->postJson('/api/items', $this->itemData);

        $response->assertCreated()
                 ->assertJsonFragment(['title' => $this->itemData['title']]);

        $this->assertDatabaseHas('items', $this->itemData);
    }

    public function testShowReturnsCorrectJsonResponse()
    {
        $item = Item::factory()->create();

        $response = $this->getJson("/api/items/{$item->id}");

        $response->assertOk()
                 ->assertJsonFragment(['title' => $item->title]);
    }

    public function testUpdatePersistsChangesAndReturnsCorrectJsonResponse()
    {
        $item = Item::factory()->create();
        $newData = ['title' => $this->faker->sentence, 'status' => 'completed'];

        $response = $this->putJson("/api/items/{$item->id}", $newData);

        $response->assertOk()
                 ->assertJsonFragment(['title' => $newData['title']]);

        $this->assertDatabaseHas('items', $newData);
    }

    public function testDestroyDeletesItemAndReturnsNoContentResponse()
    {
        $item = Item::factory()->create();

        $response = $this->deleteJson("/api/items/{$item->id}");

        $response->assertNoContent();

        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    }
}

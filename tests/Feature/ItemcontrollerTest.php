<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;
use App\Models\User;
use App\Models\Item;
use App\Models\Like;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_item_index_page(): void
    {
        $response = $this->get(route('item.index'));

        $response->assertStatus(200);
        $response->assertViewIs('item.index');
    }

    public function test_ordered_item_shows_sold_label(): void
    {

        Order::factory()->create();

        $response = $this->get(route('item.index'));

        $response->assertStatus(200)
        ->assertSee('Sold');
    }

    public function test_user_cant_see_own_item(): void
    {
        $user = User::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)
        ->get(route('item.index'));

        $response->assertViewHas('items', function ($items) use ($item) {
            return $items->contains('id', $item->id) === false;
        });
    }

    public function test_user_can_get_mylist(): void
    {
        $user = User::factory()->create();
        $liked = Item::factory()->count(3)->create();
        $unLiked = Item::factory()->count(3)->create();

        $user->likes()->attach($liked->pluck('id')->toArray());

        $response = $this->actingAs($user)
        ->get(route('item.index', ['tab' => 'mylist']));

        $response->assertStatus(200)
            ->assertViewIs('item.index');

        $response->assertViewHas('items', function ($items) use ($liked, $unLiked) {
            return $liked->every(
                fn ($item) => $items->contains('id', $item->id)
            ) && $unLiked->every(
                fn ($item) => !$items->contains('id', $item->id)
            );
        });

    }

    public function test_guest_cant_get_mylist(): void
    {
        $response = $this->get(route('item.index', ['tab' => 'mylist']));

        $response->assertStatus(200)
            ->assertViewIs('item.index');
        $response->assertViewHas('items', function ($items) {
            return $items->isEmpty();
        });
    }

    public function test_user_can_search_item(): void
    {
        $user = User::factory()->create();

        $hitItem = Item::factory()->create([
            'name' => 'test item',
        ]);

        $notHitItem = Item::factory()->create();

        $response = $this->actingAs($user)
        ->get(route('item.index', ['keyword' => 'test']));

        $response->assertStatus(200)
            ->assertViewIs('item.index');

        $response->assertViewHas('items', function ($items) use ($hitItem, $notHitItem) {
            return $items->contains('id', $hitItem->id)
                && !$items->contains('id', $notHitItem->id);
        });
    }

}

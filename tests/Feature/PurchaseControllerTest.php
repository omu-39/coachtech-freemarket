<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Order;

class PurchaseControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_purchase_item(): void
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $response = $this->actingAs($user)->get(route('purchase.index', $item->id));

        $response->assertStatus(200)
            ->assertViewIs('purchase.index');

        $response = $this->actingAs($user)->post(route('purchase.store', $item->id), [
            'item_id' => $item->id,
            'user_id' => $user->id,
            'payment_method' => 'card',
            'postal_code' => '123-4567',
            'address' => 'test address',
            'building' => 'test building',
        ]);

        $response->assertStatus(302)
            ->assertRedirect(route('item.index'));

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'payment_method' => 'card',
            'postal_code' => '123-4567',
            'address' => 'test address',
            'building' => 'test building',
        ]);
    }

    public function test_purchased_item_show_sold_label(): void
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        Order::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)->get(route('item.index'));

        $response->assertStatus(200)
            ->assertViewIs('item.index')
            ->assertSee("sold-item-{$item->id}");
    }

    public function test_user_mypage_show_purchased_items(): void
    {
        $user = User::factory()->create();
        $purchasedItem = Item::factory()->create([
            'name' => 'purchased item',
        ]);
        $notPurchasedItem = Item::factory()->create([
            'name' => 'not purchased item',
        ]);

        Order::factory()->create([
            'user_id' => $user->id,
            'item_id' => $purchasedItem->id,
        ]);

        $response = $this->actingAs($user)->get(route('profile.index', ['page' => 'buy']));

        $response->assertStatus(200)
            ->assertViewIs('profile.index')
            ->assertSee($purchasedItem->name)
            ->assertDontSee($notPurchasedItem->name);
    }

    public function test_user_can_change_payment_method(): void
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $this->actingAs($user)->post(route('purchase.store', $item->id), [
            'item_id' => $item->id,
            'user_id' => $user->id,
            'payment_method' => 'card',
            'postal_code' => '123-4567',
            'address' => 'test address',
            'building' => 'test building',
        ]);

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'payment_method' => 'card',
        ]);
    }

    public function test_user_can_change_shipping_address(): void
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();
        $updateShippingAddress = [
            'postal_code' => '987-6543',
            'address' => 'updated address',
            'building' => 'updated building',
        ];


        $response = $this->actingAs($user)
            ->get(route('purchase.index', $item->id));

        $response->assertStatus(200)
            ->assertViewIs('purchase.index')
            ->assertSee($user->postal_code)
            ->assertSee($user->address)
            ->assertSee($user?->building);

        $response = $this->actingAs($user)
            ->patch(route('purchase.update', $item->id), $updateShippingAddress)
            ->assertStatus(302)
            ->assertRedirect(route('purchase.index', $item->id));

        $response = $this->actingAs($user)
            ->get(route('purchase.index', $item->id))
            ->assertStatus(200)
            ->assertSee($updateShippingAddress['postal_code'])
            ->assertSee($updateShippingAddress['address'])
            ->assertSee($updateShippingAddress['building']);
    }

    public function test_purchased_item_has_changed_shipping_address(): void
    {
        $user = User::factory()->create([
            'postal_code' => '123-4567',
            'address' => 'test address',
            'building' => 'test building',
        ]);
        $item = Item::factory()->create();
        $updateShippingAddress = [
            'postal_code' => '987-6543',
            'address' => 'updated address',
            'building' => 'updated building',
        ];

        $this->actingAs($user)
            ->patch(route('purchase.update', $item->id), $updateShippingAddress)
            ->assertStatus(302)
            ->assertRedirect(route('purchase.index', $item->id));

        $this->actingAs($user)
            ->post(route('purchase.store', $item->id), [
                'item_id' => $item->id,
                'user_id' => $user->id,
                'payment_method' => 'card',
                'postal_code' => $updateShippingAddress['postal_code'],
                'address' => $updateShippingAddress['address'],
                'building' => $updateShippingAddress['building'],
            ]);

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'postal_code' => $updateShippingAddress['postal_code'],
            'address' => $updateShippingAddress['address'],
            'building' => $updateShippingAddress['building'],
        ]);

    }
}

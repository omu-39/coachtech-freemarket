<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\UploadedFile;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_profile_page(): void
    {
        $user = User::factory()->create();
        $purchasedItems = Item::factory()->count(3)
            ->sequence(
                ['name' => 'Purchased Item 1'],
                ['name' => 'Purchased Item 2'],
                ['name' => 'Purchased Item 3'],
            )->create();
        $listedItems = Item::factory()->count(2)
            ->sequence(
                ['name' => 'Listed Item 1'],
                ['name' => 'Listed Item 2'],
            )->create(['user_id' => $user->id]);

        $purchasedItems->each(function ($item) use ($user) {
            Order::factory()->create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
        });

        $response = $this->actingAs($user)
            ->get(route('profile.index', ['page' => 'sell']));

        $response->assertStatus(200)
            ->assertViewIs('profile.index')
            ->assertSee($user->profile_image)
            ->assertSee($user->name)
            ->assertSee($listedItems[0]->name)
            ->assertSee($listedItems[1]->name)
            ->assertDontSee($purchasedItems[0]->name)
            ->assertDontSee($purchasedItems[1]->name);

        $response = $this->actingAs($user)
            ->get(route('profile.index', ['page' => 'buy']));

        $response->assertStatus(200)
            ->assertViewIs('profile.index')
            ->assertSee($user->profile_image)
            ->assertSee($user->name)
            ->assertSee($purchasedItems[0]->name)
            ->assertSee($purchasedItems[1]->name)
            ->assertSee($purchasedItems[2]->name)
            ->assertDontSee($listedItems[0]->name)
            ->assertDontSee($listedItems[1]->name);
    }

    public function test_user_can_change_profile(): void
    {
        $user = User::factory()->create([
            'name' => 'Original Name',
            'postal_code' => '000-0000',
            'address' => 'Original Address',
            'building' => 'Original Building',
        ]);

        $response = $this->actingAs($user)
            ->put(route('profile.edit'), [
                'name' => 'Updated Name',
                'profile_image' => UploadedFile::fake()->image('updated-profile-image.jpg'),
                'postal_code' => '123-4567',
                'address' => 'Updated Address',
                'building' => 'Updated Building',
            ]);

        $response = $this->actingAs($user)->get(route('profile.show'));

        $response->assertStatus(200)
            ->assertViewIs('profile.edit')
            ->assertSee('Updated Name')
            ->assertSee('storage/' . $user->profile_image)
            ->assertSee('123-4567')
            ->assertSee('Updated Address')
            ->assertSee('Updated Building');
    }
}

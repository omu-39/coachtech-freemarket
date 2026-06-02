<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class LikeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_like_item(): void
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();
        $beforeCount = $item->likes()->count();

        $this->actingAs($user)
            ->post(route('like.store', $item->id));

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $afterCount = $item->fresh()->likes()->count();

        $this->assertEquals($beforeCount + 1, $afterCount);

        $response = $this->get(route('item.show', $item->id));

        $response->assertStatus(200)
            ->assertSee((string) $afterCount);
    }

    public function test_user_can_like_item_and_image_changes(): void
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('item.show', $item->id));

        $response->assertStatus(200)
            ->assertSee('/images/ハートロゴ_デフォルト.png');

        $response = $this->actingAs($user)
            ->withHeader('Referer', route('item.show', $item->id))
            ->post(route('like.store', $item->id));

        $response->assertStatus(302)
            ->assertRedirect(route('item.show', $item->id));

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)
            ->get(route('item.show', $item->id));

        $response->assertStatus(200)
            ->assertSee('/images/ハートロゴ_ピンク.png');
    }

    public function test_user_can_unlike_item(): void
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $user->likes()->attach($item->id);
        $beforeCount = $item->likes()->count();

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)
            ->withHeader('Referer', route('item.show', $item->id))
            ->delete(route('like.destroy', $item->id));

        $afterCount = $item->fresh()->likes()->count();

        $response->assertStatus(302)
            ->assertRedirect(route('item.show', $item->id));

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $this->assertEquals($beforeCount - 1, $afterCount);

        $response = $this->actingAs($user)
            ->get(route('item.show', $item->id));

        $response->assertStatus(200)
            ->assertSee('/images/ハートロゴ_デフォルト.png')
            ->assertSee((string) $afterCount);
    }
}

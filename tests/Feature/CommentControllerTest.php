<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_comment(): void
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $beforeCount = $item->comments()->count();

        $response = $this->actingAs($user)
            ->withHeader('Referer', route('item.show', $item->id))
            ->post(route('comment.store', $item->id), [
                'comment' => 'test comment',
            ]);

        $response->assertStatus(302)
            ->assertRedirect(route('item.show', $item->id));

        $afterCount = $item->fresh()->comments()->count();

        $this->assertEquals($beforeCount + 1, $afterCount);
        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'test comment',
        ]);
    }

    public function test_guest_cant_comment(): void
    {
        $item = Item::factory()->create();

        $response = $this->post(route('comment.store', $item->id), [
            'comment' => 'test comment',
        ]);

        $response->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->assertDatabaseMissing('comments', [
            'comment' => 'test comment',
        ]);
    }

    public function test_null_comment_show_validation_message(): void
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->withHeader('Referer', route('item.show', $item->id))
            ->post(route('comment.store', $item->id), [
                'comment' => null,
            ]);

        $response->assertStatus(302)
            ->assertRedirect(route('item.show', $item->id))
            ->assertSessionHasErrors(['comment' => 'コメントを入力してください']);
    }

    public function test_long_comment_show_validation_message(): void
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $longComment = str_repeat('a', 256);

        $response = $this->actingAs($user)
            ->withHeader('Referer', route('item.show', $item->id))
            ->post(route('comment.store', $item->id), [
                'comment' => $longComment,
            ]);

        $response->assertStatus(302)
            ->assertRedirect(route('item.show', $item->id))
            ->assertSessionHasErrors(['comment' => 'コメントは255文字以内で入力してください']);
    }
}

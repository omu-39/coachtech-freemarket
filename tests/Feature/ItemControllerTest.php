<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\UploadedFile;

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

    // 保留
    public function test_search_keyword_is_preserved_on_mylist_tab(): void
    {
        $user = User::factory()->create();
        $hitItem = Item::factory()->create(['name' => 'test item',]);
        $notHitItem = Item::factory()->create(['name' => 'cant see item',]);

        $user->likes()->attach([$hitItem->id, $notHitItem->id]);

        $response = $this->actingAs($user)
            ->get(route('item.index', ['keyword' => 'test']));

        $response->assertStatus(200)
            ->assertSee('test item')
            ->assertDontSee('cant see item');

        $nextResponse = $this->actingAs($user)
        ->get(route('item.index', ['tab' => 'mylist', 'keyword' => 'test']));

        $nextResponse->assertStatus(200)
            ->assertSee('test item')
            ->assertDontSee('cant see item');

    }

    public function test_user_can_get_item_show_page(): void
    {

        $user = User::factory()->create();
        $item = Item::factory()->create();
        $user->likes()->attach($item->id);
        $comment = $item->comments()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'test comment',
        ]);

        $category = Category::factory()->create();
        $item->categories()->attach($category->id);

        $likesCount = $item->likes()->count();
        $commentsCount = $item->comments()->count();

        $response = $this->get(route('item.show', $item->id));

        $response->assertStatus(200)
            ->assertViewIs('item.show');

        $response->assertSee($item->image)
            ->assertSee($item->name)
            ->assertSee($item->brand)
            ->assertSee((string) number_format(floor($item->price * 1.1)))
            ->assertSee((string) $likesCount)
            ->assertSee((string) $commentsCount)
            ->assertSee($item->description)
            ->assertSee($item->categories()->first()->name)
            ->assertSee($item->status)
            ->assertSee('storage/' . $user->image)
            ->assertSee($comment->user->name)
            ->assertSee($comment->comment);
    }

    public function test_item_shows_categories(): void
    {
        $item = Item::factory()->create();
        $categories = Category::factory()->count(3)->create();

        $item->categories()->attach($categories->pluck('id')->toArray());

        $response = $this->get(route('item.show', $item->id));

        $response->assertStatus(200)
            ->assertViewIs('item.show');

        foreach ($categories as $category) {
            $response->assertSee($category->name);
        }
    }

    public function test_user_can_sell_item(): void
    {
        $user = User::factory()->create();
        $sellerItem = Item::factory()->create([
            'user_id' => $user->id,
        ]);
        $categories = Category::factory()->count(2)->create();
        $sellerItem->categories()->attach($categories->pluck('id')->toArray());

        $response = $this->actingAs($user)
            ->get(route('item.create'));

        $response->assertStatus(200)
            ->assertViewIs('item.sell');

        $this->actingAs($user)
            ->post(route('item.store'), [
                'name' => $sellerItem->name,
                'brand' => $sellerItem->brand,
                'price' => $sellerItem->price,
                'description' => $sellerItem->description,
                'status' => $sellerItem->status,
                'categories' => $categories->pluck('id')->toArray(),
                'image' => $sellerItem->image,
            ]);

        $this->assertDatabaseHas('items', [
            'name' => $sellerItem->name,
            'brand' => $sellerItem->brand,
            'price' => $sellerItem->price,
            'description' => $sellerItem->description,
            'status' => $sellerItem->status,
            'user_id' => $user->id,
            'image' => $sellerItem->image
        ]);

        $this->assertDatabaseHas('category_item', [
            'item_id' => $sellerItem->id,
            'category_id' => $categories[0]->id,
        ]);

        $this->assertDatabaseHas('category_item', [
            'item_id' => $sellerItem->id,
            'category_id' => $categories[1]->id,
        ]);
    }

}

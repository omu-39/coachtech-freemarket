<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_item_index_page(): void
    {
        $response = $this->get(route('item.index'));

        $response->assertStatus(200);
        $response->assertView('item.index');
    }

    public function test_sold_item_show_sold_label(): void
    {

        Order::create()

        $response = $this->get(route('item.index'));

        $response->assertStatus(200);
        $response->assertView('item.index');
    }
}

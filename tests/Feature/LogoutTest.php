<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_logout_success(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
        ->post(route('logout'));

        $response->assertRedirect(route('item.index'));
        $this->assertGuest();
    }
}

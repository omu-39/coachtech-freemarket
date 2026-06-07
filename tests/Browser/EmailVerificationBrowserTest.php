<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class EmailVerificationBrowserTest extends DuskTestCase
{

    use DatabaseMigrations;

    public function test_user_can_visit_verification_page_from_verification_link(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get(route('verification.notice'));

        $response->assertStatus(200)
            ->assertViewIs('auth.verify-email')
            ->assertSee('http://localhost:8025');

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('verification.notice'))
                ->clickLink('認証はこちらから')
                ->assertUrlIs('http://localhost:8025/');
        });
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Laravel\Dusk\Browser;   

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_registered_sent_verification_email(): void
    {
        Notification::fake();

        $this->post(route('register'), [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $user = User::first();

        Notification::assertSentTo($user, VerifyEmail::class);
    }

    public function test_user_is_redirected_after_email_verification(): void
    {
        $user = User::factory()->unverified()->create();

        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email)
            ]
        );

        $response = $this->actingAs($user)->get($url);

        $response->assertStatus(302)
            ->assertRedirect(route('profile.edit'). '?verified=1');
    }

}
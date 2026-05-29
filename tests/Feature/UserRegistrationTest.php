<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{

    use RefreshDatabase;

    /**
     * ユーザー登録テスト
     */
    public function test_user_register_validation_message_name(): void
    {
        $response = $this->post('/register', [
            'name' => '',
        ]);

        $response->assertSessionHasErrors([
            'name'=> 'お名前を入力してください'
        ]);
    }

    public function test_user_register_validation_message_email(): void
    {
        $response = $this->post('/register', [
            'email' => '',
        ]);

        $response->assertSessionHasErrors([
            'email' => 'メールアドレスを入力してください'
        ]);
    }

    public function test_user_register_validation_message_password(): void
    {
        $response = $this->post('/register', [
            'password' => '',
        ]);

        $response->assertSessionHasErrors([
            'password' => 'パスワードを入力してください'
        ]);
    }

    public function test_user_register_validation_message_password_min(): void
    {
        $response = $this->post('/register', [
            'password' => '7777777',
        ]);

        $response->assertSessionHasErrors([
            'password' => 'パスワードは8文字以上で入力してください'
        ]);
    }

    public function test_user_register_validation_message_password_confirmation(): void
    {
        $response = $this->post('/register', [
            'password' => '88888888',
            'password_confirmation' => '8881234125'
        ]);

        $response->assertSessionHasErrors([
            'password' => 'パスワードと一致しません'
        ]);
    }

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::insert([
            [
                'name' => '山田太郎',
                'email' => 'yamada@example.com',
                'password' => bcrypt('password'),
                'postal_code' => '100-0000',
                'address' => '東京都千代田区1-1',
                'build' => '山田ビル',
                'profile_image' => 'https://example.com/profile.jpg',
            ],
        ]);
    }
}

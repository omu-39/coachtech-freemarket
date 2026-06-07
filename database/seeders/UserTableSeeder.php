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
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'postal_code' => '100-0000',
                'address' => '東京都千代田区1-1',
                'building' => '山田ビル',
                'image' => 'https://example.com/profile.jpg',
            ],
        ]);
    }
}

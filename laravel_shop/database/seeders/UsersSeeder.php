<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password'=>Hash::make(Str::random(100)),
            'phone_number' => '+981234567',
            'api_token' => Str::random(10),
            'remember_token' => Str::random(32),
        ]);
    }
}

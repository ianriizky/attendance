<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Administrator',
            'email' => 'admin@attendance.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'role' => UserRole::Admin,
            'status' => UserStatus::Active,
            'remember_token' => Str::random(10),
        ]);
    }
}

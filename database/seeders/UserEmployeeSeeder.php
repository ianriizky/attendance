<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $created_at = Date::createFromDate(2012, 12, 12);

        User::query()->create([
            'name' => 'Rendra',
            'email' => 'rendragituloh@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'status' => UserStatus::Active,
            'remember_token' => Str::random(10),
            'created_at' => $created_at,
        ])->employee()->create([
            'date_of_birth' => Date::parse(2011, 11, 11),
            'city' => 'Jogja',
        ]);

        User::query()->create([
            'name' => 'Khariz',
            'email' => 'kharizajaah@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'status' => UserStatus::Active,
            'remember_token' => Str::random(10),
            'created_at' => $created_at,
        ])->employee()->create([
            'date_of_birth' => Date::parse(2012, 12, 12),
            'city' => 'Bantul',
        ]);

        User::query()->create([
            'name' => 'Joko',
            'email' => 'jokoterdepan@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'status' => UserStatus::Active,
            'remember_token' => Str::random(10),
            'created_at' => $created_at,
        ])->employee()->create([
            'date_of_birth' => Date::parse(2010, 10, 10),
            'city' => 'Sleman',
        ]);

        User::query()->create([
            'name' => 'Mariyam',
            'email' => 'maiyamyuk@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'status' => UserStatus::Active,
            'remember_token' => Str::random(10),
            'created_at' => $created_at,
        ])->employee()->create([
            'date_of_birth' => Date::parse(2009, 9, 9),
            'city' => 'Gunung Kidul',
        ]);
    }
}

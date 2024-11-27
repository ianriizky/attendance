<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Database\Seeder;

class TestingPresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Employee::all() as $employee) {
            Presence::factory()->count(3)->for($employee)->create();
        }
    }
}

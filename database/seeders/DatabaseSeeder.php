<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Achievement;
use App\Models\CriminalHistory;
use App\Models\MedicalHistory;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountriesSeeder::class);
        Student::factory(30)->create();
        MedicalHistory::factory(10)->create();
        CriminalHistory::factory(10)->create();
        Achievement::factory(10)->create();

        \App\Models\Admin::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@admin.com',
        ]);
    }
}

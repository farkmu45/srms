<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Achievement;
use App\Models\CriminalHistory;
use App\Models\MedicalHistory;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\Submission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountriesSeeder::class);
        Student::factory(10)->create();
        MedicalHistory::factory(10)->create();
        CriminalHistory::factory(10)->create();
        Achievement::factory(10)->create();
        Mentor::factory(10)->create();
        Submission::factory(10)->create();

        \App\Models\Admin::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@admin.com',
        ]);
    }
}

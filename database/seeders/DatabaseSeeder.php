<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Student::factory(30)->create();

        \App\Models\Admin::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@admin.com',
        ]);
    }
}

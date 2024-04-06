<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class CountriesSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->file = '/database/countries.csv';
        $this->tablename = 'countries';
        $this->timestamps = false;
        $this->foreignKeyCheck = false;
        $this->truncate = false;
    }
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::disableQueryLog();
        parent::run();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('technologies')->insert([
            ['name' => 'Laravel'],
            ['name' => 'Vue.js'],
            ['name' => 'React'],
            ['name' => 'Docker'],
        ]);
    }
}

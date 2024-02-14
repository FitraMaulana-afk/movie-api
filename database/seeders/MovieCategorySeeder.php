<?php

namespace Database\Seeders;

use App\Models\MovieCategory;
use Database\Factories\MovieCategoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MovieCategory::factory(10)->create();
    }
}
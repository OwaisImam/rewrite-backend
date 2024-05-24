<?php

namespace Database\Seeders;

use App\Models\Individual;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndividualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Individual::factory()->create();
    }
}
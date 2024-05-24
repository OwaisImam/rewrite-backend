<?php

namespace Database\Seeders;

use App\Constants\DefaultValues;
use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DefaultValues::CATEGORIES;

        foreach($categories as $category)
        {
            $exist = Categories::where('name', $category['name'])->first();

            if(!$exist) {
                Categories::create($category);
            }
        }
    }
}
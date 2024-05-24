<?php

namespace Database\Factories;

use App\Models\Categories;
use App\Models\Individual;
use App\Models\Upload;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Individual>
 */
class IndividualFactory extends Factory
{
    protected $model = Individual::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $upload = Upload::factory()->create();

        $category = Categories::first();

        return [
            'name' => $this->faker->name(),
            'content' => $this->faker->paragraph(),
            'status' => 1,
            'upload_id' => $upload->id,
            'category_id' => $category->id,
            'date_of_birth' => $this->faker->date(),
            'date_of_death' => $this->faker->date(),
        ];
    }
}
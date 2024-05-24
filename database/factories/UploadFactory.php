<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UploadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = $this->faker->randomElement($imageExtensions);
        $fileName = $this->faker->unique()->word . '.' . $extension;

        return [
            'file_original_name' => $fileName,
            'file_name' => $fileName,
            'upload_by' => 1,
            'file_size' => $this->faker->numberBetween(1000, 1000000), // Size in bytes
            'extension' => $extension,
            'type' => 'image/' . $extension,
        ];
    }
}
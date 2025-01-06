<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobApplication>
 */
class JobApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => fake()->company(),
            'role' => fake()->text(50),
            'job_description' => fake()->text(200),
            'job_requirements' => fake()->text(200),
            'anual_salary' => fake()->numberBetween(2000000, 10000000),
            'cv' => UploadedFile::fake()->create('cv.pdf'),
            'status' => 'New',
        ];
    }
}

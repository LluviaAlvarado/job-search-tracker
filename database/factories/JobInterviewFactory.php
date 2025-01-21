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
            'job_application_id' => fake()->numberBetween(0, 100),
            'title' => fake()->text(20),
            'contact_info' => fake()->email(),
            'description' => fake()->text(100),
            'scheduled_time' => fake()->dateTime(),
        ];
    }
}

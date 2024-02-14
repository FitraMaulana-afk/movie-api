<?php

namespace Database\Factories;

use App\Models\MovieCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'movie_category_id' => MovieCategory::factory(),
            'title' => $this->faker->name(),
            'synopics' => $this->faker->text(200),
            'image' => UploadedFile::fake()->image('image.png'),
            'image_banner' => UploadedFile::fake()->image('image.png'),
            'director' => $this->faker->name(),
            'duration' => $this->faker->randomNumber(2),
            'usia' => $this->faker->randomNumber(2),
            'realese_date' => $this->faker->date(),
        ];
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'publish_date' => $this->faker->date('Y-m-d', '2024-01-01'),
            'author_id' => \App\Models\Author::factory(), // Automatically create an author if none exists
        ];
    }
}

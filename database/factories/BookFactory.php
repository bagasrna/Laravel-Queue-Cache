<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2,4)), //membuat kata yang panjangnya random antara 2 sampai 4 kata
            'author' => $this->faker->name,
            'category' => $this->faker->randomElement(['Anime', 'Sejarah', 'Biologi', 'Humor', 'Drama']),
        ];
    }
}

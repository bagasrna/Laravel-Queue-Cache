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
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->sentence(mt_rand(10,25)),
            // 'body' => $this->faker->paragraphs(mt_rand(3,6)),
            'body' => collect($this->faker->paragraphs(mt_rand(5,10)))
                        ->map(fn($p) => "<p>$p</p>")
                        ->implode(''),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['name' => 'string', 'en' => 'array', 'ua' => 'array', 'ru' => 'array'])]
    public function definition(): array
    {
        return [
            'en' => [
                'name' => $this->faker->word,
            ],
            'ua' => [
                'name' => $this->faker->word,
            ],
            'ru' => [
                'name' => $this->faker->word,
            ],
        ];
    }
}

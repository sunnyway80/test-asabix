<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class PostFactory extends Factory
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
            'name' => $this->faker->unique()
                ->sentence(3),
            'en' => [
                'title' => $this->faker->unique()
                    ->sentence(3),
                'description' => $this->faker->text(25),
                'content' => $this->faker->text(25),
            ],
            'ua' => [
                'title' => $this->faker->unique()
                    ->sentence(2),
                'description' => $this->faker->text(25),
                'content' => $this->faker->text(25),
            ],
            'ru' => [
                'title' => $this->faker->unique()
                    ->sentence(2),
                'description' => $this->faker->text(25),
                'content' => $this->faker->text(25),
            ],
        ];
    }
}

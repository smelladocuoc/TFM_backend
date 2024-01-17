<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coleccion_Elemento>
 */
class Coleccion_ElementoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'coleccion_id' => $this->faker->numberBetween(1, 9),
            'elemento_id' => $this->faker->numberBetween(1, 100)
        ];
    }
}

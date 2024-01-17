<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Elemento>
 */
class ElementoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'imagen' => $this->faker->imageUrl(150, 150),
            'fecha_publicacion' => $this->faker->dateTime(),
            'comentario' => $this->faker->paragraph(),
            'adquirido' => $this->faker->numberBetween(0, 1)
        ];
    }
}

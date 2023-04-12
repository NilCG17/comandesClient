<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comandes>
 */
class ComandesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mail' => $this->faker->email,
            'data_comanda' => $this->faker->dateTimeBetween('now', '+1 week'),
            'parking' => $this->faker->boolean(50),
            'catering' => $this->faker->boolean(50),
            'estat' => 'pendent',
        ];
    }
}

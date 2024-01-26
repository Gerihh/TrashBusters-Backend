<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dump>
 */
class DumpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=> $this->faker->word,
            "description"=> $this->faker->text,
            "location"=> $this->faker->address,
            "openingHours"=> $this->faker->time,
            "contactPhone"=> $this->faker->phoneNumber,
            "contactEmail"=> $this->faker->email,
        ];
    }
}

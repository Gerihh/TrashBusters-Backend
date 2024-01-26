<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title"=> $this->faker->word,
            "description"=> $this->faker->text,
            "date"=> $this->faker->date,
            "location"=> $this->faker->city,
            "participants"=> $this->faker->numberBetween(5, 100),
            "active"=> $this->faker->boolean,
            "creatorId"=> $this->faker->randomElement(User::pluck('id')),
        ];
    }
}

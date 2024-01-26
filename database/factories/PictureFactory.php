<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Picture>
 */
class PictureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "url"=> $this->faker->imageUrl,
            "description"=> $this->faker->text,
            "timestamp"=> $this->faker->dateTime,
            "creatorId"=> $this->faker->randomElement(User::pluck('id')),
            "eventId"=> $this->faker->randomElement(Event::pluck('id')),
        ];
    }
}

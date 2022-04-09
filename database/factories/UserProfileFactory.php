<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 2,
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'age' => $this->faker->numberBetween(18,70),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'location' => $this->faker->address(),
            'information' => $this->faker->sentence(),
            'profile_picture_id'=> $this->faker->numberBetween(2,5)
        ];
    }
}

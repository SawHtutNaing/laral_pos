<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Psy\info;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'company' => fake()->company(),
            'information' => fake()->text(),
            'user_id' => User::all()->random()->id,
            'photo' => config('info.default_contact_photo')

        ];
    }
}

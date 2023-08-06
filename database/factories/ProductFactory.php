<?php

namespace Database\Factories;

use App\Models\brand;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $unitName = ['bags', 'pack', 'darzon'];
        return [
            'name' => fake()->name(),
            'brand_id' => brand::all()->random()->id,
            'actually_price' => rand(200, 1000),
            'sales_price' => rand(200, 1000),
            'total_stock' => rand(5, 20),
            'unit' => $unitName[rand(0, 2)],
            'more_information' => fake()->text(),
            'user_id' => User::all()->random()->id,
            'photo' => config('info.default_contact_photo')




        ];
    }
}

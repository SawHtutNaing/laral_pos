<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Vouncher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VouncherRecords>
 */
class VouncherRecordsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product_id =  Product::all()->random()->id;
        $each_cost = Product::findOrFail($product_id)->sales_price;
        $quantity =  rand(10, 20);



        return [
            'vouncher_id' => Vouncher::all()->random()->id,
            'product_id' => $product_id,
            'product_id' => Product::all()->random()->id,
            'quantity' => $quantity,
            'cost' => ($each_cost * $quantity)
        ];
    }
}

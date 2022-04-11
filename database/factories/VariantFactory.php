<?php

namespace Database\Factories;

use Domains\Catalog\Models\Product;
use Domains\Catalog\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;

class VariantFactory extends Factory
{
    protected $model = Variant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = Product::factory()->create();
        $cost = $this->faker->boolean ? $product->cost : ($product->cost + $this->faker->numberBetween(100, 8000));
        $shippable = $this->faker->boolean;

        return [
            'name' => $this->faker->words(4, true),
            'cost' => $cost,
            'retail' => ($product->cost === $cost) ? $product->retail : ($product->retail + $this->faker->numberBetween(100, 8000)),
            'height' => $shippable ? $this->faker->numberBetween(100, 10000) : null,
            'width' => $shippable ? $this->faker->numberBetween(100, 10000) : null,
            'length' => $shippable ? $this->faker->numberBetween(100, 10000) : null,
            'weight' => $shippable ? $this->faker->numberBetween(100, 10000) : null,
            'active' => $this->faker->boolean,
            'shippable' => $shippable,
            'product_id' => $product->id
        ];
    }
}

<?php

namespace Database\Factories;

use Domains\Catalog\Models\Variant;
use Domains\Customer\Models\Order;
use Domains\Customer\Models\OrderLine;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderLineFactory extends Factory
{
    protected $model = OrderLine::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $variant = Variant::factory()->create();

        return [
            'name' => $variant->name,
            'description' => $variant->product->description,
            'cost' => $variant->cost,
            'retail' => $variant->retail,
            'quantity' => $this->faker->numberBetween(1, 8),
            'purchasable_id' => $variant->id,
            'purchasable_type' => 'variant',
            'order_id' => Order::factory()->create()
        ];
    }
}

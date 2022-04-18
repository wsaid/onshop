<?php

namespace Database\Factories;

use Domains\Customer\Enums\CartStatus;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class CartFactory extends Factory
{
    protected $model = Cart::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $useCoupon = $this->faker->boolean();

        return [
            'status' => Arr::random(CartStatus::toLabels()),
            'coupon' => $useCoupon ? $this->faker->imei() : null,
            'total' => $this->faker->numberBetween(10000, 100000),
            'reduction' => $useCoupon ? $this->faker->numberBetween(150, 500): 0,
            'user_id' => User::factory()->create()
        ];
    }
}

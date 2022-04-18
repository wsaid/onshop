<?php

namespace Database\Factories;

use Domains\Customer\Enums\OrderStatus;
use Domains\Customer\Models\Location;
use Domains\Customer\Models\Order;
use Domains\Customer\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $useCoupon = $this->faker->boolean();
        $status = Arr::random(OrderStatus::toLabels());

        return [
            'number' => $this->faker->bothify('ORD-####-####-####'),
            'status' => $status,
            'coupon' => $useCoupon ? $this->faker->imei() : null,
            'total' => $this->faker->numberBetween(10000, 100000),
            'reduction' => $useCoupon ? $this->faker->numberBetween(150, 500): 0,
            'user_id' => User::factory()->create(),
            'shipping_id' => Location::factory()->create(),
            'billing_id' => Location::factory()->create(),
            'completed_at' => $this->faker->boolean() ? now() : null,
            'cancelled_at' => (OrderStatus::from($status) === OrderStatus::CANCELLED()) ? now() : null
        ];
    }
}

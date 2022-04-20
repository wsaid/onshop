<?php

namespace Database\Factories;

use Domains\Customer\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $maxUses = $this->faker->numberBetween(1, 1000);

        return [
            'code' => $this->faker->bothify('coup-###-???-##'),
            'reduction' => $this->faker->numberBetween(100, 3000),
            'uses' => $this->faker->numberBetween(0, $maxUses),
            'max_uses' => $this->faker->boolean() ? $maxUses : null,
            'active' => $this->faker->boolean()
        ];
    }
}

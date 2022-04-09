<?php

namespace Database\Factories;

use Domains\Customer\Models\Address;
use Domains\Customer\Models\Location;
use Domains\Customer\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => Arr::random([
                'Home',
                'Office'
            ]),
            'billing' => $this->faker->boolean,
            'user_id' => User::factory()->create(),
            'location_id' => Location::factory()->create()
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class AddressFactory extends Factory
{
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

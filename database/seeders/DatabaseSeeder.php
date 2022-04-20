<?php

namespace Database\Seeders;

use Domains\Catalog\Models\Variant;
use Domains\Customer\Models\Address;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\Coupon;
use Domains\Customer\Models\OrderLine;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Address::factory(5)->create();
        Variant::factory(50)->create();

        Cart::factory(10)->create();
        OrderLine::factory(20)->create();
        Coupon::factory(20)->create();
    }
}

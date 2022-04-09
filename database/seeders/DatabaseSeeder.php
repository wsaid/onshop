<?php

namespace Database\Seeders;

use Domains\Catalog\Models\Product;
use Domains\Customer\Models\Address;
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
        Product::factory(50)->create();
    }
}

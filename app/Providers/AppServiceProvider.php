<?php

namespace App\Providers;

use Domains\Catalog\Models\Variant;
use Domains\Customer\Projectors\CartProjector;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Spatie\EventSourcing\Facades\Projectionist;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Projectionist::addProjector(
            CartProjector::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::enforceMorphMap([
            'variant' => Variant::class
        ]);
    }
}

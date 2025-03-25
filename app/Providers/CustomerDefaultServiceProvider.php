<?php

namespace App\Providers;

use App\Models\Owner;
use Illuminate\Support\ServiceProvider;

class CustomerDefaultServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        if (!Owner::where('dni', '00000000')->exists()) {
            // create admin
            Owner::create([
                'name' => 'cliente',
                'surname' => 'generico',
                'dni' => '00000000'
            ]);
        }
    }
}

<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AdminUserServiceProvider extends ServiceProvider
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
        if (!User::where('dni', '00000000')->exists()) {
            // create admin
            User::create([
                'name' => 'cliente',
                'surname' => 'generico',
                'dni' => '00000000'
            ]);
        }
    }
}

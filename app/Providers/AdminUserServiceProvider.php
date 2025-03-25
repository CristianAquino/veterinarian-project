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
        if (!User::where('email', 'admin@admin.com')->exists()) {
            // create admin
            User::create([
                'name' => 'administrator',
                'surname' => 'administrator',
                'email' => 'admin@admin.com',
                'password' => '12345678',
                'role' => 'admin',
                'dni' => '00000000'
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // vaciamos la tabla service
        Service::truncate();

        $faker = Faker::create();

        $services = [
            'General consultation',
            'Vaccination',
            'Grooming',
            'Boarding',
            'Deworming'
        ];

        foreach ($services as $service) {
            Service::create([
                'name' => $service,
                'description' => $faker->optional(0.8)->text(48),
                'price' => $faker->randomFloat(2, 10, 100)
            ]);
        }
    }
}

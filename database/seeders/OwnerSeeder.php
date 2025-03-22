<?php

namespace Database\Seeders;

use App\Models\Owner;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // vaciamos la tabla owners
        Owner::truncate();

        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            # code...
            Owner::create([
                'name' => $faker->name(),
                'surname' => $faker->lastName() . ' ' . $faker->lastName(),
                'phone' => $faker->phoneNumber(),
                'email' => $faker->unique()->safeEmail(),
                'dni' => $faker->unique()->randomNumber(8, true)
            ]);
        }
    }
}

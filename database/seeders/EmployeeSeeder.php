<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // vaciamos la tabla user
        User::truncate();

        $faker = Faker::create();

        $specialities = [
            'Surgery',
            'Cardiology',
            'Dermatology',
            'Ophthalmology'
        ];

        for ($i = 0; $i < 5; $i++) {
            # code...
            $role = $i < 4 ? User::ROLE[1] : User::ROLE[0];
            $speciality = $i < 4 ? $specialities[$i] : null;

            User::create([
                'name' => $faker->name(),
                'surname' =>  $faker->lastName() . ' ' . $faker->lastName(),
                'password' => '12345678',
                'role' => $role,
                'speciality' => $speciality,
                'phone' => $faker->optional(0.8)->phoneNumber(),
                'email' => $faker->unique()->safeEmail(),
                'dni' => $faker->unique()->randomNumber(8, true)
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // vaciamos la tabla pets 
        Pet::truncate();

        $faker = Faker::create();
        $owners = Owner::all();
        $breeds = [
            'boxer',
            'husky',
            'poodle',
            'bulldog',
            null
        ];

        foreach ($owners as $owner) {
            # code...
            $gender = $faker->randomElement(Pet::GENDER);
            $specie = $faker->randomElement(Pet::SPECIES);
            $breed = strtolower($specie) == 'cat'
                ? null : $faker->randomElement($breeds);

            Pet::create([
                'name' => $faker->name($gender),
                'species' => $specie,
                'breed' => $breed,
                'age' => $faker->optional(0.8)->numberBetween(1, 15),
                'weight' => $faker->optional(0.8)->randomFloat(2, 1, 50),
                'gender' => $gender,
                'owner_id' => $owner->id,
            ]);
        }
    }
}
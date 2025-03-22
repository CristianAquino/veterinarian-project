<?php

namespace Database\Seeders;

use App\Models\Medication;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // vaciamos la tabla medication
        Medication::truncate();

        $faker = Faker::create();

        for ($i = 0; $i < 15; $i++) {
            # code...
            Medication::create([
                'name' => $faker->word(),
                'description' => $faker->text(48),
                'type' => $faker->randomElement(Medication::TYPE),
            ]);
        }
    }
}
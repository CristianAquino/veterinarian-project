<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Pet;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MedicalRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // vaciamos la tabla medical_records
        MedicalRecord::truncate();

        $faker = Faker::create();
        $pets = Pet::all();

        foreach ($pets as $pet) {
            $user = Appointment::where('owner_id', $pet->owner_id)->first();
            MedicalRecord::create([
                'pet_id' => $pet->id,
                'user_id' => $user->user_id,
                'diagnosis' => $faker->text(48),
                'treatment' => $faker->optional(0.8)->text(48),
            ]);
        }
    }
}
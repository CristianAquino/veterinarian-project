<?php

namespace Database\Seeders;

use App\Models\MedicalRecord;
use App\Models\Medication;
use App\Models\Prescription;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PrescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // vaciamos la tabla prescription
        Prescription::truncate();

        $faker = Faker::create();
        $records = MedicalRecord::all();
        $medications = Medication::all();

        for ($i = 0; $i < 7; $i++) {
            $record = $faker->randomElement($records);
            for ($j = 0; $j < $faker->numberBetween(2, 5); $j++) {
                # code...
                Prescription::create([
                    'dosage' => $faker->sentence(4),
                    'medication_name' => $faker->optional(0.8)->sentence(4),
                    'notes' => $faker->optional(0.8)->text(10),
                    'medical_record_id' => $record->id,
                    'medication_id' => $faker->randomElement($medications)->id,
                    'user_id' => $record->user_id,
                ]);
            }
        }
    }
}
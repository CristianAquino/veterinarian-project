<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Medication;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // vaciamos la tabla inventory
        Inventory::truncate();

        $faker = Faker::create();
        $medications = Medication::all();

        foreach ($medications as $medication) {
            # code...
            $expired_date =
                $faker->dateTimeBetween('-' . $faker->numberBetween(1, 3) . 'year', '+' . $faker->numberBetween(1, 3) . 'year');
            $expired = Carbon::parse(now())->diffInDays($expired_date) <= 0 ? true : false;

            Inventory::create([
                'batch_number' => $faker->randomNumber(9, true),
                'quantity' => $faker->numberBetween(1, 100),
                'expiry_date' => $expired_date,
                'expired' => $expired,
                'unit_price' => $faker->randomFloat(2, 3, 100),
                'medication_id' => $medication->id,
            ]);
        }
    }
}
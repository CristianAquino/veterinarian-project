<?php

namespace Database\Seeders;

use App\Models\Alert;
use App\Models\Inventory;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class AlertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // vaciamos la tabla alert
        Alert::truncate();

        $faker = Faker::create();
        $inventories = Inventory::all();

        foreach ($inventories as $inventory) {
            if (Carbon::parse(now())->diffInDays($inventory->expiry_date) < 30) {
                if (Carbon::parse(now())->diffInDays($inventory->expiry_date) < 7) {
                    $type = 'danger';
                } elseif (Carbon::parse(now())->diffInDays($inventory->expiry_date) < 15) {
                    $type = 'warning';
                } elseif (Carbon::parse(now())->diffInDays($inventory->expiry_date) < 30) {
                    $type = 'info';
                }
                Alert::create([
                    'inventory_id' => $inventory->id,
                    'message' => $faker->sentence(10),
                    'type' => $type
                ]);
            } else {
                null;
            }
        }
    }
}
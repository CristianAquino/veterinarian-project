<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\AppointmentService;
use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Owner;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // vaciamos la tabla bill and bill_items
        Bill::truncate();
        BillItem::truncate();
        $faker = Faker::create();
        $owners = Owner::all();

        foreach ($owners as $owner) {
            # code...
            $appointments = Appointment::where('owner_id', $owner->id)->where('status', 'completed')->get();
            if (count($appointments) > 0) {
                foreach ($appointments as $appointment) {
                    # code...
                    $appS = AppointmentService::where('appointment_id', $appointment->id)->where('is_done', false)->get();
                    if (count($appS) > 0) {
                        $b = Bill::create([
                            'owner_id' => $owner->id,
                        ]);

                        $total_amount = 0;
                        foreach ($appS as $appSe) {
                            $quantity = $faker->numberBetween(1, 5);
                            $price = $appSe->service->price;

                            $bI = BillItem::create([
                                'bill_id' => $b->id,
                                'appointment_service_id' => $appSe->id,
                                'quantity' => $quantity,
                                'price' => $price,
                                'subtotal' => $price * $quantity
                            ]);

                            $total_amount += $bI->subtotal;
                        }

                        $b->total_amount = $total_amount;
                        $b->save();
                    }
                }
            }
        }
    }
}

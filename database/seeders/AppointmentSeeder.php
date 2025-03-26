<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\AppointmentService;
use App\Models\Owner;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // vaciamos la tabla appointments and appointment_services
        Appointment::truncate();
        AppointmentService::truncate();

        $faker = Faker::create();
        $owners = Owner::all();
        $services = Service::all();

        $schedules = [
            '08:00:00',
            '09:00:00',
            '10:00:00',
            '11:00:00',
            '12:00:00',
            '13:00:00',
            '14:00:00'
        ];

        foreach ($owners as $owner) {
            # code...
            if ($owner->dni == '00000000') {
                continue;
            } else {
                $a = Appointment::create([
                    'reason' => $faker->text(64),
                    'date' => $faker->dateTimeBetween('now', '+' . $faker->numberBetween(1, 15) . 'days')->format('Y-m-d'),
                    'start_time' => $faker->randomElement($schedules),
                    'is_emergency' => false,
                    'status' => $faker->randomElement(Appointment::STATUS),
                    'owner_id' => $owner->id,
                    'user_id' => $faker->numberBetween(2, 5)
                ]);
                $service = $faker->randomElement($services);
                $service->appointments()->attach($a);
            }
        }
    }
}

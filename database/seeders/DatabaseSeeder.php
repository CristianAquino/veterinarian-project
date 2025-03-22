<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Schema::disableForeignKeyConstraints();
        $this->call([
            EmployeeSeeder::class,
            ServiceSeeder::class,
            MedicationSeeder::class,
            InventorySeeder::class,
            OwnerSeeder::class,
            PetSeeder::class,
            AppointmentSeeder::class,
            MedicalRecordSeeder::class,
            BillSeeder::class,
            PrescriptionSeeder::class,
            AlertSeeder::class
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
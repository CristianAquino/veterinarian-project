<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->string('medication_name', 32)->nullable()->default(null);
            $table->string('dosage', 32);
            $table->text('notes')->nullable()->default(null);
            $table->foreignUuid('medical_record_id')
                ->constrained('medical_records')
                ->cascadeOnDelete();
            $table->foreignId('medication_id')
                ->nullable()
                ->constrained('medications')
                ->cascadeOnDelete()
                ->default(null);
            $table->foreignUuid('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('prescriptions');
        Schema::enableForeignKeyConstraints();
    }
};
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
        Schema::create('bill_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->foreignUuid('bill_id')
                ->constrained('bills')
                ->cascadeOnDelete();
            $table->foreignId('appointment_service_id')
                ->nullable()
                ->constrained('appointment_services')
                ->nullOnDelete()
                ->default(null);
            $table->foreignId('inventory_id')
                ->nullable()
                ->constrained('inventory')
                ->nullOnDelete()
                ->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('bill_items');
        Schema::enableForeignKeyConstraints();
    }
};
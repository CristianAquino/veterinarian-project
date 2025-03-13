<?php

use App\Models\Pet;
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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32);
            $table->enum('species', Pet::SPECIES);
            $table->string('breed')->nullable()->default(null);
            $table->integer('age')->nullable()->default(null);
            $table->decimal('weight', 5, 2)->nullable()->default(null);
            $table->enum('gender', PET::GENDER);
            $table->foreignUuid('owner_id')
                ->constrained('owners')
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
        Schema::dropIfExists('pets');
        Schema::enableForeignKeyConstraints();
    }
};
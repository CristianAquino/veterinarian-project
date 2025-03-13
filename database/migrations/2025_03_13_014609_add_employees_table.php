<?php

use App\Models\User;
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
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname', 64);
            $table->enum('role', User::ROLE)->default(User::ROLE[0]);
            $table->string('speciality', 64)->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('dni', 8);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('surname');
            $table->dropColumn('role');
            $table->dropColumn('speciality');
            $table->dropColumn('phone');
            $table->dropColumn('dni');
        });
    }
};
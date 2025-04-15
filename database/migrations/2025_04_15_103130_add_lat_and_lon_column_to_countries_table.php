<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->decimal('lat', 10, 6)->nullable(); // Широта
            $table->decimal('lon', 11, 6)->after('lat')->nullable(); // Долгота
        });
    }

    public function down(): void
    {
        Schema::table('regins', function (Blueprint $table) {
            //
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->string('name_dat', 255)->nullable()->index();
        });

        Schema::table('regions', function (Blueprint $table) {
            $table->string('name_dat', 255)->nullable()->index();
        });
    }

    public function down(): void
    {
        //
    }
};

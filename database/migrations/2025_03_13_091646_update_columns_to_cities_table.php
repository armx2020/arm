<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->string('name_ru', 255)->index();
            $table->string('name_en', 255);
            $table->string('name_ru_locative', 255);
        });
    }

    public function down(): void
    {
        //
    }
};

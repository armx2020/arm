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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('price')->nullable();
            $table->string('name', 40);
            $table->boolean('activity')->default(true);
            $table->string('address', 128);
            $table->text('description')->nullable();
           
            $table->unsignedBigInteger('city_id')->nullable(); // исправить
            $table->foreign('city_id')->references('id')->on('cities');

            $table->unsignedBigInteger('parenttable_id')->nullable();
            $table->string('parenttable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};

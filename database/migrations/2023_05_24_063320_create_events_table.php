<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date_to_start');
            $table->string('name', 40);
            $table->boolean('activity')->default(true);
            $table->text('description')->nullable();
            $table->string('address', 128);
            $table->string('image', 255)->nullable();

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');

            $table->morphs('parent');
        });

        DB::statement(
            'ALTER TABLE `events` ADD FULLTEXT fulltext_index(name, description)'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

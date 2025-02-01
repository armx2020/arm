<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 255)->index();
        });

        DB::table('site_types')->insert([
            ['name' => 'домашняя'],
            ['name' => 'область'],
            ['name' => 'город'],
            ['name' => 'тип сущности'],
            ['name' => 'категория'],
            ['name' => 'сущность'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('site_types');
    }
};

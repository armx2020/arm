<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('regions', function (Blueprint $table) {
            $table->dropColumn('code');
        });

        Schema::table('regions', function (Blueprint $table) {
            $table->string('name_ru', 255)->index();
            $table->string('name_en', 255);
            $table->string('name_ru_locative', 255);
            $table->string('code', 2);
            $table->foreignId('country_id')->index()->default(190);
        });
    }

    public function down(): void
    {
        //
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->integer('checked')->index()->default(1);
        });

        Schema::table('entities', function (Blueprint $table) {
            $table->integer('checked')->index()->default(1);
        });
    }

    public function down(): void
    {
        //
    }
};

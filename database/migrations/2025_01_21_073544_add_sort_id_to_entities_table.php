<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('entities', function (Blueprint $table) {
            $table->integer('sort_id')->index()->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('entity', function (Blueprint $table) {
            //
        });
    }
};

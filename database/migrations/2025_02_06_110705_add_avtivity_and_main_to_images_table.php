<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->boolean('activity')->default(true)->index();
            $table->boolean('main')->default(false)->index();
        });
    }

    public function down(): void
    {
        //
    }
};

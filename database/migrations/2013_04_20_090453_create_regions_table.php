<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->index();
            $table->unsignedInteger('code')->default(0)->index();
            $table->string('InEnglish', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};

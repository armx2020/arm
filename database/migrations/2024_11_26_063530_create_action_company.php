<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('action_company', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('action_id')->constrained();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('action_company');
    }
};

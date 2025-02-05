<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->foreignId('entity_id')->nullable()->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('appeals', function (Blueprint $table) {
            //
        });
    }
};

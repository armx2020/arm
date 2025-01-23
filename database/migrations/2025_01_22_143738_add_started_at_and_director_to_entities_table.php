<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('entities', function (Blueprint $table) {
            $table->string('director', 255)->nullable();
            $table->timestamp('started_at')->nullable();
            $table->text('email', 96)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('entities', function (Blueprint $table) {
            //
        });
    }
};

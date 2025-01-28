<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('entity_types', function (Blueprint $table) {
            $table->string('transcription', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('entity_types', function (Blueprint $table) {
            //
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 255);
            $table->boolean('activity')->default(true)->index();
            $table->text('description')->nullable()->fulltext();
            $table->unsignedInteger('price')->nullable();
            $table->string('image', 255)->nullable();
        });

        DB::statement(
            'ALTER TABLE actions ADD FULLTEXT fulltext_index(name, description)'
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};

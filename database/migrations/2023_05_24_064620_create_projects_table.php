<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 255);
            $table->boolean('activity')->default(true)->index();
            $table->text('description')->nullable();
            $table->string('address', 128)->nullable();
            $table->unsignedInteger('donations_need')->default(0);
            $table->unsignedInteger('donations_have')->default(0);
            $table->string('image', 255)->nullable();
            $table->foreignId('city_id')->default(1)->constrained();
            $table->foreignId('region_id')->default(1)->constrained();
            $table->morphs('parent');
            $table->text('comment')->nullable();
        });

        DB::statement(
            'ALTER TABLE `projects` ADD FULLTEXT fulltext_index(name, description, address)'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

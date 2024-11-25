<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date')->index();
            $table->string('name', 255);
            $table->boolean('activity')->default(true)->index();
            $table->text('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('image1', 255)->nullable();
            $table->string('image2', 255)->nullable();
            $table->string('image3', 255)->nullable();
            $table->string('image4', 255)->nullable();
            $table->foreignId('city_id')->default(1)->constrained();
            $table->foreignId('region_id')->default(1)->constrained();
            $table->morphs('parent');
            $table->text('comment')->nullable();
        });

        DB::statement(
            'ALTER TABLE news ADD FULLTEXT fulltext_index(name, description)'
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};

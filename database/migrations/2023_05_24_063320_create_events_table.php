<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date_to_start');
            $table->string('name', 255)->index();
            $table->boolean('activity')->default(true)->index();
            $table->text('description')->nullable();
            $table->string('address', 128)->nullable();
            $table->string('image', 255)->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('city_id')->default(1)->constrained();
            $table->foreignId('region_id')->default(1)->constrained();
            $table->morphs('parent');
            $table->text('comment')->nullable();
        });

        DB::statement(
            'ALTER TABLE events ADD FULLTEXT fulltext_index(name, description)'
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 40)->fulltext();
            $table->enum('type', ['resume', 'vacancy'])->default('resume')->index();
            $table->boolean('activity')->default(true);
            $table->string('address', 128)->nullable();
            $table->text('description')->nullable()->fulltext();
            $table->foreignId('city_id')->default(1)->constrained();
            $table->foreignId('region_id')->default(1)->constrained();
            $table->morphs('parent');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};

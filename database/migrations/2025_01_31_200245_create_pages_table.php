<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('url', 255)->index();
            $table->foreignId('site_type_id')->nullable()->constrained();
            $table->string('title', 255)->index()->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('quantity_entity')->unsigned()->nullable()->default(0);
            $table->boolean('index')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};

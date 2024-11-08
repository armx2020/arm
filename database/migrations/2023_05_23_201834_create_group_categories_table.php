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
        Schema::create('group_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 40);
            $table->integer('sort_id');
            $table->boolean('activity')->default(true);
        });

        DB::statement(
            'ALTER TABLE `group_categories` ADD FULLTEXT fulltext_index(name)'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_categories');
    }
};

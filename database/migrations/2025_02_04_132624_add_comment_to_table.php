<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('site_maps', function (Blueprint $table) {
            $table->text('meta_1')->nullable();
            $table->text('meta_2')->nullable();
            $table->text('meta_3')->nullable();
        });

        Schema::table('entities', function (Blueprint $table) {
            $table->text('meta_1')->nullable();
            $table->text('meta_2')->nullable();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->text('meta_1')->nullable();
            $table->text('meta_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table', function (Blueprint $table) {
            //
        });
    }
};

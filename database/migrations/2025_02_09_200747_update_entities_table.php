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
        Schema::table('entities', function (Blueprint $table) {
            $table->dropColumn('top');
            $table->tinyInteger('region_top')->default(0)->nullable()->after('city_id');
            $table->tinyInteger('city_top')->default(0)->nullable()->after('region_top');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entities', function (Blueprint $table) {
            $table->dropColumn(['region_top', 'city_top']);
        });
    }
};

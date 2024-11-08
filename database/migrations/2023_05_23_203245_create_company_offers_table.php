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
        Schema::create('company_offers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 40);
            $table->boolean('activity')->default(true);
            $table->string('address', 128)->nullable();
            $table->text('description')->nullable();
            $table->integer('price')->default(0);
            $table->string('unit_of_price')->default('RUB');
            $table->string('image', 255)->nullable();
            $table->string('image1', 255)->nullable();
            $table->string('image2', 255)->nullable();
            $table->string('image3', 255)->nullable();
            $table->string('image4', 255)->nullable();

            $table->string('phone', 36)->nullable()->unique();
            $table->string('web', 255)->nullable()->unique();
            $table->string('viber', 36)->nullable()->unique();
            $table->string('whatsapp', 36)->nullable()->unique();
            $table->string('instagram', 255)->nullable()->unique();
            $table->string('vkontakte', 255)->nullable()->unique();
            $table->string('telegram', 255)->nullable()->unique();

            $table->unsignedBigInteger('city_id')->default(1);
            $table->foreign('city_id')->references('id')->on('cities');

            $table->unsignedBigInteger('region_id')->default(1);
            $table->foreign('region_id')->references('id')->on('regions');

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('offer_category_id');
            $table->foreign('offer_category_id')->references('id')->on('offer_categories')->cascadeOnDelete();
        });

        DB::statement(
            'ALTER TABLE company_offers ADD FULLTEXT fulltext_index(name, description)'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_offers');
    }
};

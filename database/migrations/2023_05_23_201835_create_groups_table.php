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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 40);
            $table->boolean('activity')->default(true);
            $table->string('address', 128);
            $table->text('description')->nullable();
            $table->string('phone', 36)->unique();
            $table->string('web', 255)->nullable()->unique();
            $table->string('viber', 36)->nullable()->unique();
            $table->string('whatsapp', 36)->nullable()->unique();
            $table->string('instagram', 255)->nullable()->unique();
            $table->string('vkontakte', 255)->nullable()->unique();
            $table->string('telegram', 255)->nullable()->unique();
            $table->string('image', 255)->nullable();
            $table->string('image1', 255)->nullable();
            $table->string('image2', 255)->nullable();
            $table->string('image3', 255)->nullable();
            $table->string('image4', 255)->nullable();

            $table->unsignedBigInteger('city_id')->nullable(); // исправить
            $table->foreign('city_id')->references('id')->on('cities');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('group_category_id');
            $table->foreign('group_category_id')->references('id')->on('group_categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};

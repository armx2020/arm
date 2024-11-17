<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_offers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 40)->fulltext();
            $table->boolean('activity')->default(true)->index();
            $table->string('address', 128)->nullable();
            $table->text('description')->nullable()->fulltext();
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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('city_id')->default(1)->constrained();
            $table->foreignId('region_id')->default(1)->constrained();
            $table->foreignId('category_id')->default(1)->constrained()->cascadeOnDelete();
            $table->foreignId('company_id')->constrained()->nullable();
            $table->softDeletes('deleted_at', 0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_offers');
    }
};

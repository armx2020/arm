<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 255)->fulltext();
            $table->boolean('activity')->default(true);
            $table->string('address', 128)->nullable()->index();
            $table->string('image', 255)->nullable();
            $table->text('description')->nullable()->fulltext();
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
            $table->softDeletes('deleted_at', 0);
            $table->text('comment')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

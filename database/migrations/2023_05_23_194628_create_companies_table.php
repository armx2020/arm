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
            $table->string('name', 255);
            $table->boolean('activity')->default(true);
            $table->string('address', 128)->nullable()->index();
            $table->string('image', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('phone', 36)->nullable();
            $table->string('web', 255)->nullable();
            $table->string('viber', 36)->nullable();
            $table->string('whatsapp', 36)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('vkontakte', 255)->nullable();
            $table->string('telegram', 255)->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('city_id')->default(1)->constrained();
            $table->foreignId('region_id')->default(1)->constrained();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->softDeletes('deleted_at', 0);
            $table->text('comment')->nullable();
        });

        DB::statement(
            'ALTER TABLE companies ADD FULLTEXT fulltext_index(name, description, phone)'
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

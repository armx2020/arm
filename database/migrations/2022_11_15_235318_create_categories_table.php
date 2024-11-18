<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 40)->fulltext();
            $table->integer('sort_id')->index();
            $table->boolean('activity')->default(true);
            $table->enum('type', ['group', 'offer', 'event']);
            $table->foreignId('category_id')->nullable()->constrained();
            $table->softDeletes('deleted_at', 0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

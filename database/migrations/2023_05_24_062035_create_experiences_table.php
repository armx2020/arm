<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('experiences', function (Blueprint $table) {
    //         $table->id();
    //         $table->timestamps();
    //         $table->string('name', 40);
    //         $table->text('description')->nullable();
    //         $table->date('start_worktime');
    //         $table->date('end_worktime');

    //         $table->unsignedBigInteger('resume_id');
    //         $table->foreign('resume_id')->references('id')->on('resumes')->cascadeOnDelete();
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    // public function down(): void
    // {
    //     Schema::dropIfExists('experiences');
    // }
};

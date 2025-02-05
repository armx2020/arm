<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(
            'ALTER TABLE appeals ADD FULLTEXT fulltext_index(`name`, message, phone)'
        );
    }

    public function down(): void
    {
        //
    }
};

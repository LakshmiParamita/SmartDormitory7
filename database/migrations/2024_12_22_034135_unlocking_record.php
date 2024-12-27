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
        Schema::create('unlocking_records', function (Blueprint $table) {
            $table->id();
            $table->timestamp('timestamp');
            $table->string('activity');
            $table->binary('image')->nullable();
        });

        DB::statement("ALTER TABLE unlocking_records MODIFY image LONGBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unlocking_records');
    }
};

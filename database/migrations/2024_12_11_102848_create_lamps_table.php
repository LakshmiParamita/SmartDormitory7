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
        Schema::create('lamps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gedung_id');
            $table->string('name');
            $table->boolean('is_on')->default(false);
            $table->timestamps();

            $table->foreign('gedung_id')->references('id')->on('gedungs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamps');
    }
};

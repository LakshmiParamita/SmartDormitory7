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
        Schema::create('waters', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sensor', 4)->unique();
            $table->string('nama_gedung');
            $table->enum('kualitas_air', ['Bersih', 'Keruh', 'Kotor']);
            $table->decimal('debit', 8, 2)->default(0);
            $table->decimal('tekanan_air', 8, 2)->default(0); 
            $table->decimal('batas_normal_debit', 8, 2)->default(0); 
            $table->decimal('batas_normal_tekanan', 8, 2)->default(0); // batas normal tekanan
            $table->boolean('status_kebocoran')->default(false);
            $table->boolean('status_penanganan')->default(false);
            $table->boolean('status_cek_pompa')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waters');
    }
};

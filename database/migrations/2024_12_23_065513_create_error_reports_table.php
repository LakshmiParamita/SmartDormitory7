<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErrorReportsTable extends Migration
{
    public function up()
    {
        Schema::create('error_reports', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('building_name'); // Nama gedung, contoh: Gedung 1, Gedung A
            $table->string('error_title'); // Judul laporan error
            $table->text('error_description'); // Deskripsi laporan error
            $table->enum('status', ['Diajukan', 'Diproses', 'Selesai'])->default('Diajukan'); // Status laporan
            $table->timestamps(); // Waktu pembuatan dan pembaruan
        });
    }

    public function down()
    {
        Schema::dropIfExists('error_reports');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('floor');
            $table->string('cctv_url_right')->nullable();
            $table->string('cctv_url_left')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buildings');
    }
}
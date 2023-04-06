<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlusterisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klusterisasi', function (Blueprint $table) {
            $table->id();
            $table->json('dt_dataset');
            $table->json('dt_pembentukan_centroid');
            $table->json('dt_perhitungan_centroid');
            $table->json('dt_nilai_minimum_kelas');
            $table->json('dt_new_centroid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('klusterisasi');
    }
}

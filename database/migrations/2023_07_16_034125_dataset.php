<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Dataset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset', function (Blueprint $table) {
            
            $table->id();
            $table->bigInteger("klusterisasi_id");
            $table->string("nama");
            $table->integer("time");
            $table->integer("salah_wr");
            $table->integer("salah_gnd");
            $table->integer("jumlah_gnd_wr");
            $table->integer("nilai");
            $table->string("tipe_nilai");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dataset', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 225);
            $table->string('nip', 30);
            $table->string('sk_terakhir', 100);
            $table->string('tmt', 100);
            $table->unsignedBigInteger('id_jabatan');
            $table->date('tmt_berkala_akan_datang');
            $table->unsignedBigInteger('id_unit_kerja');
            $table->timestamps();

            $table->foreign('id_jabatan')->references('id')->on('jabatan');
            $table->foreign('id_unit_kerja')->references('id')->on('unit_kerja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}

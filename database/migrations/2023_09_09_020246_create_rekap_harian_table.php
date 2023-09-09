<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_harian', function (Blueprint $table) {
            $table->id();
            $table->string('jenjang');
            $table->string('nama_asrama');
            $table->string('nama_siswa');
            $table->string('nama_kelas');
            $table->string('keterangan');
            $table->unsignedBigInteger('id_sesi_kelas');
            $table->string('tgl');
            $table->timestamps(); // Kolom untuk updated_at dan created_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekap_harian');
    }
};

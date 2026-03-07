<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->increments('id_presensi');
            $table->integer('id_siswa');
            $table->integer('id_periode');
            $table->integer('jumlah_hadir')->nullable();
            $table->integer('jumlah_sakit')->nullable();
            $table->integer('jumlah_izin')->nullable();
            $table->integer('jumlah_alpha')->nullable();
            $table->unsignedInteger('id_file')->nullable();

            $table->foreign('id_siswa')
                  ->references('id_siswa')
                  ->on('siswa')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->foreign('id_periode')
                  ->references('id_periode')
                  ->on('periode_penilaian')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->foreign('id_file')
                  ->references('id_file')
                  ->on('file_import')
                  ->nullOnDelete()
                  ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
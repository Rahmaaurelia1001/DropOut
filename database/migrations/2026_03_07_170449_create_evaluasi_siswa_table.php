<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluasi_siswa', function (Blueprint $table) {
            $table->increments('id_evaluasi');

            $table->integer('id_siswa');
            $table->integer('id_kelas');
            $table->integer('id_periode');

            $table->decimal('nilai_rata_rata', 5, 2)->nullable();

            $table->string('pekerjaan_ortu')->nullable();
            $table->string('pendidikan_ortu')->nullable();

            $table->unsignedInteger('id_file')->nullable();

            $table->foreign('id_siswa')
                ->references('id_siswa')
                ->on('siswa')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_kelas')
                ->references('id_kelas')
                ->on('kelas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_periode')
                ->references('id_periode')
                ->on('periode_penilaian')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_file')
                ->references('id_file')
                ->on('file_import')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluasi_siswa');
    }
};
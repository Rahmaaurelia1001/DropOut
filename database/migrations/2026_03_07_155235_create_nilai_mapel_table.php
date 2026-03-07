<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_mapel', function (Blueprint $table) {
            $table->increments('id_nilai');
            $table->integer('id_siswa');
            $table->integer('id_mapel');
            $table->integer('id_periode');
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->unsignedInteger('id_file')->nullable();

            $table->foreign('id_siswa')
                  ->references('id_siswa')
                  ->on('siswa')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->foreign('id_mapel')
                  ->references('id_mapel')
                  ->on('mata_pelajaran')
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
        Schema::dropIfExists('nilai_mapel');
    }
};
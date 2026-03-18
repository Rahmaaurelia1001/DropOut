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
        Schema::create('master_rekomendasi', function (Blueprint $table) {
            $table->id('id_master_rekomendasi');

            // kategori risiko: Tinggi, Sedang, Rendah
            $table->string('kategori_risiko');

            // faktor dominan: Nilai Rata Rata Akademik, Ketidak hadiran, dll
            $table->string('faktor_dominan');

            // isi rekomendasi
            $table->text('deskripsi_rekomendasi');

            // status aktif (biar bisa di-nonaktifkan tanpa dihapus)
            $table->boolean('is_active')->default(true);

            // timestamp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_rekomendasi');
    }
};
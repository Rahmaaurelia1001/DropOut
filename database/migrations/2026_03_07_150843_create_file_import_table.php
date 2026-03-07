<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('file_import', function (Blueprint $table) {
            $table->increments('id_file');
            $table->string('nama_file');
            $table->enum('jenis_data', ['rapor', 'presensi']);
            $table->dateTime('tanggal_upload')->useCurrent();
            $table->unsignedBigInteger('uploaded_by')->nullable();
            $table->text('file_path')->nullable();

            $table->foreign('uploaded_by')
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete()
                  ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_import');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Ubah tipe id_kelas agar cocok dengan tabel kelas (int tanpa unsigned)
        $table->integer('id_kelas')->nullable()->change();
        
        // Tambah foreign key
        $table->foreign('id_kelas')
              ->references('id_kelas')
              ->on('kelas')
              ->onDelete('set null')
              ->onUpdate('cascade');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['id_kelas']);
        $table->unsignedInteger('id_kelas')->nullable()->change();
    });
}
};

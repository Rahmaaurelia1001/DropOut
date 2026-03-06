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
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['admin','wali_kelas','kepala_sekolah'])
              ->default('wali_kelas');

        $table->unsignedInteger('id_kelas')->nullable();
        // TANPA foreign key dulu
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['role','id_kelas']);
    });
}   
};

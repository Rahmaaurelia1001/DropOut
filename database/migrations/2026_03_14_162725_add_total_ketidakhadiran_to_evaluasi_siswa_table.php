<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('evaluasi_siswa', function (Blueprint $table) {
            $table->integer('total_ketidakhadiran')
                  ->default(0)
                  ->after('nilai_rata_rata');
        });
    }

    public function down(): void
    {
        Schema::table('evaluasi_siswa', function (Blueprint $table) {
            $table->dropColumn('total_ketidakhadiran');
        });
    }
};
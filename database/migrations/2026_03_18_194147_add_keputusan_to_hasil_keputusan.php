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
        Schema::table('hasil_keputusan', function (Blueprint $table) {
            $table->text('tindak_lanjut_final')->nullable()->after('faktor_dominan');
            $table->timestamp('tanggal_keputusan')->nullable()->after('tindak_lanjut_final');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_keputusan', function (Blueprint $table) {
            $table->dropColumn(['tindak_lanjut_final', 'tanggal_keputusan']);
        });
    }
};
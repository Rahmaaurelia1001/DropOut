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
        $table->text('deskripsi_tambahan')->nullable()->after('tindak_lanjut_final');
    });
}

public function down(): void
{
    Schema::table('hasil_keputusan', function (Blueprint $table) {
        $table->dropColumn('deskripsi_tambahan');
    });
}
};

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
    Schema::create('rekomendasi_komentar', function (Blueprint $table) {
        $table->id();
        $table->integer('id_hasil');
        $table->unsignedBigInteger('user_id');
        $table->string('role', 50);
        $table->string('nama_user');
        $table->text('komentar');
        $table->timestamp('created_at')->useCurrent();
    });
}

public function down(): void
{
    Schema::dropIfExists('rekomendasi_komentar');
}
};

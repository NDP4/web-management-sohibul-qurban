<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sohibul_qurban', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sohibul');
            $table->string('qurban_untuk')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->enum('status_pembayaran', ['belum_bayar', 'sudah_bayar', 'titip_panitia'])->default('belum_bayar');
            $table->enum('metode_pembayaran', ['tunai', 'transfer'])->nullable();
            $table->string('bukti_transfer', 1024)->nullable(); // Increased length to store Google Drive file ID
            $table->enum('jenis_hewan', ['sapi', 'kambing']);
            $table->boolean('is_collective')->default(true)->comment('true = kolektif 7 orang, false = 1 orang');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sohibul_qurban');
    }
};

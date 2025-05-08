<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kwitansi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sohibul_qurban_id')->constrained('sohibul_qurban')->onDelete('cascade');
            $table->date('tanggal_pembayaran');
            $table->decimal('nominal', 12, 2);
            $table->string('nomor_kwitansi')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kwitansi');
    }
};

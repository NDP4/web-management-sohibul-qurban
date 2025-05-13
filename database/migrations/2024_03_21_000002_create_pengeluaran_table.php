<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pedagang');
            $table->date('tanggal_pengeluaran');
            $table->decimal('nominal', 12, 2);
            $table->string('keterangan');
            $table->string('bukti_pengeluaran')->nullable();
            $table->string('nomor_pengeluaran')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};

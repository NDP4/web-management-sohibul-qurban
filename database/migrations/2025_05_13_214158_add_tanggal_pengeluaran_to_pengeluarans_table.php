<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->date('tanggal_pengeluaran')->after('jumlah');
        });
    }

    public function down()
    {
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->dropColumn('tanggal_pengeluaran');
        });
    }
};

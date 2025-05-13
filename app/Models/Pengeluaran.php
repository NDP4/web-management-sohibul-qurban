<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluarans';

    protected $fillable = [
        'keterangan',
        'jumlah',
        'tanggal_pengeluaran',
        'bukti_path'
    ];
}

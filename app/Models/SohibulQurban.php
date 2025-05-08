<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SohibulQurban extends Model
{
    protected $table = 'sohibul_qurban';

    protected $fillable = [
        'nama_sohibul',
        'qurban_untuk',
        'rt',
        'rw',
        'alamat',
        'nomor_telepon',
        'status_pembayaran',
        'metode_pembayaran',
        'bukti_transfer',
        'jenis_hewan',
        'is_collective',
        'catatan',
    ];

    protected $casts = [
        'is_collective' => 'boolean',
    ];

    public function kwitansi(): HasOne
    {
        return $this->hasOne(Kwitansi::class);
    }
}

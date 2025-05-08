<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kwitansi extends Model
{
    protected $table = 'kwitansi';

    protected $fillable = [
        'sohibul_qurban_id',
        'tanggal_pembayaran',
        'nominal',
        'nomor_kwitansi'
    ];

    protected $casts = [
        'tanggal_pembayaran' => 'date',
        'nominal' => 'decimal:2'
    ];

    public function sohibulQurban(): BelongsTo
    {
        return $this->belongsTo(SohibulQurban::class);
    }
}

<?php

namespace App\Exports;

use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KeuanganExport implements FromCollection, WithHeadings, WithMapping
{
    protected $keuangan;
    protected $pengeluaran;

    public function __construct($keuangan)
    {
        $this->keuangan = $keuangan;
        $this->pengeluaran = Pengeluaran::orderBy('created_at')->get();
    }

    public function collection()
    {
        $pemasukan = $this->keuangan->map(function ($item) {
            return [
                'Tanggal' => $item->tanggal_pembayaran,
                'Jenis' => 'Pemasukan',
                'Keterangan' => 'Pembayaran dari ' . $item->sohibulQurban->nama_sohibul,
                'Jumlah' => $item->nominal,
            ];
        });

        $pengeluaran = $this->pengeluaran->map(function ($item) {
            return [
                'Tanggal' => $item->created_at->format('Y-m-d'),
                'Jenis' => 'Pengeluaran',
                'Keterangan' => $item->keterangan,
                'Jumlah' => -$item->jumlah,
            ];
        });

        return $pemasukan->concat($pengeluaran)->sortBy('Tanggal');
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Jenis',
            'Keterangan',
            'Jumlah',
        ];
    }

    public function map($row): array
    {
        return [
            $row['Tanggal'],
            $row['Jenis'],
            $row['Keterangan'],
            $row['Jumlah'],
        ];
    }
}

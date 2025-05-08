<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KeuanganExport implements FromCollection, WithHeadings, WithMapping
{
    protected $keuangan;

    public function __construct($keuangan)
    {
        $this->keuangan = $keuangan;
    }

    public function collection()
    {
        return $this->keuangan;
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'No Kwitansi',
            'Nama Sohibul',
            'Jenis Hewan',
            'Tipe',
            'Nominal'
        ];
    }

    public function map($row): array
    {
        static $counter = 0;
        $counter++;

        return [
            $counter,
            $row->tanggal_pembayaran->format('d/m/Y'),
            $row->nomor_kwitansi,
            $row->sohibulQurban->nama_sohibul,
            ucfirst($row->sohibulQurban->jenis_hewan),
            $row->sohibulQurban->jenis_hewan == 'sapi'
                ? ($row->sohibulQurban->is_collective ? 'Kolektif (1/7)' : 'Individual')
                : 'Individual',
            $row->nominal
        ];
    }
}

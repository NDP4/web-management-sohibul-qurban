<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SohibulQurbanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $sohibulQurban;

    public function __construct($sohibulQurban)
    {
        // Sort the collection by RT and RW numerically
        $this->sohibulQurban = $sohibulQurban->sortBy(function ($item) {
            return sprintf('%010d%010d', (int)$item->rt, (int)$item->rw);
        });
    }

    public function collection()
    {
        return $this->sohibulQurban;
    }

    public function headings(): array
    {
        return [
            'No',
            'RT/RW',
            'Alamat',
            'Nama Sohibul',
            'Qurban Untuk',
            'Nomor Telepon',
            'Jenis Hewan',
            'Tipe',
            'Status Pembayaran',
            'Catatan'
        ];
    }

    public function map($row): array
    {
        static $counter = 0;
        $counter++;

        return [
            $counter,
            $row->rt . '/' . $row->rw,
            $row->alamat,
            $row->nama_sohibul,
            $row->qurban_untuk ?: $row->nama_sohibul,
            $row->nomor_telepon ?: '-',
            ucfirst($row->jenis_hewan),
            $row->jenis_hewan == 'sapi'
                ? ($row->is_collective ? 'Kolektif (1/7)' : 'Individual')
                : 'Individual',
            str_replace('_', ' ', ucfirst($row->status_pembayaran)),
            $row->catatan ?: '-'
        ];
    }
}

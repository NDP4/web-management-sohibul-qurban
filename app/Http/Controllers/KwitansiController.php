<?php

namespace App\Http\Controllers;

use App\Models\Kwitansi;
use App\Models\SohibulQurban;
use Illuminate\Http\Request;
use PDF;

class KwitansiController extends Controller
{
    public function index()
    {
        $kwitansiHistory = Kwitansi::with('sohibulQurban')->latest()->get();

        $availableSohibul = SohibulQurban::where('status_pembayaran', 'sudah_bayar')
            ->whereDoesntHave('kwitansi')
            ->get();

        return view('kwitansi.index', compact('kwitansiHistory', 'availableSohibul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sohibul_qurban_id' => 'required|exists:sohibul_qurban,id',
            'tanggal_pembayaran' => 'required|date',
            'nominal' => 'required|numeric|min:0'
        ]);

        $nomor = 'KW-' . date('Ymd') . '-' . str_pad(Kwitansi::count() + 1, 4, '0', STR_PAD_LEFT);

        $kwitansi = Kwitansi::create([
            'sohibul_qurban_id' => $request->sohibul_qurban_id,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'nominal' => $request->nominal,
            'nomor_kwitansi' => $nomor
        ]);

        return redirect()
            ->route('kwitansi.index')
            ->with('success', 'Kwitansi berhasil dibuat dan tersimpan. Silakan download melalui tombol Download.');
    }

    public function download(Kwitansi $kwitansi)
    {
        $pdf = PDF::loadView('kwitansi.pdf', compact('kwitansi'))
            ->setPaper('a4', 'landscape')
            ->setOption('margin-bottom', 30)
            ->setOption('enable-smart-shrinking', true);

        $filename = str_replace(' ', '_', strtolower($kwitansi->sohibulQurban->nama_sohibul)) . '_kwitansi.pdf';

        return $pdf->download($filename);
    }
}

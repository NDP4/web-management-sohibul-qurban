<?php

namespace App\Http\Controllers;

use App\Models\Kwitansi;
use App\Models\SohibulQurban;
use App\Exports\KeuanganExport;
use App\Exports\SohibulQurbanExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class KwitansiController extends Controller
{
    public function index()
    {
        $kwitansiHistory = Kwitansi::with('sohibulQurban')
            ->join('sohibul_qurban', 'kwitansi.sohibul_qurban_id', '=', 'sohibul_qurban.id')
            ->orderByRaw('CAST(sohibul_qurban.rt AS UNSIGNED) asc')
            ->orderByRaw('CAST(sohibul_qurban.rw AS UNSIGNED) asc')
            ->select('kwitansi.*')
            ->get();

        $availableSohibul = SohibulQurban::where('status_pembayaran', 'sudah_bayar')
            ->whereDoesntHave('kwitansi')
            ->orderByRaw('CAST(rt AS UNSIGNED) asc')
            ->orderByRaw('CAST(rw AS UNSIGNED) asc')
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

    public function exportSohibulQurbanPDF()
    {
        $sohibulQurban = SohibulQurban::orderByRaw('CAST(rw AS UNSIGNED) asc')
            ->orderByRaw('CAST(rt AS UNSIGNED) asc')
            ->orderBy('alamat')
            ->get();

        $pdf = PDF::loadView('kwitansi.export.sohibul-qurban-pdf', compact('sohibulQurban'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('rekap-sohibul-qurban.pdf');
    }

    public function exportSohibulQurbanExcel()
    {
        $fileName = 'rekap-sohibul-qurban.xlsx';

        $sohibulQurban = SohibulQurban::orderByRaw('CAST(rw AS UNSIGNED) asc')
            ->orderByRaw('CAST(rt AS UNSIGNED) asc')
            ->orderBy('alamat')
            ->get();

        return Excel::download(new SohibulQurbanExport($sohibulQurban), $fileName);
    }

    public function exportKeuanganPDF()
    {
        $keuangan = Kwitansi::with('sohibulQurban')
            ->orderBy('tanggal_pembayaran')
            ->get();

        $pengeluaran = \App\Models\Pengeluaran::orderBy('created_at')->get();
        $totalPemasukan = $keuangan->sum('nominal');
        $totalPengeluaran = $pengeluaran->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $pdf = PDF::loadView('kwitansi.export.keuangan-pdf', compact('keuangan', 'pengeluaran', 'totalPemasukan', 'totalPengeluaran', 'saldo'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('rekap-keuangan-qurban.pdf');
    }

    public function exportKeuanganExcel()
    {
        $fileName = 'rekap-keuangan-qurban.xlsx';

        $keuangan = Kwitansi::with('sohibulQurban')
            ->orderBy('tanggal_pembayaran')
            ->get();

        return Excel::download(new KeuanganExport($keuangan), $fileName);
    }
}

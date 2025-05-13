<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::latest()->get();
        $total = Pengeluaran::sum('jumlah');
        return view('pengeluaran.index', compact('pengeluarans', 'total'));
    }

    public function create()
    {
        return view('pengeluaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'jumlah' => 'required|numeric',
            'drive_file_id' => 'required'
        ]);

        try {
            $pengeluaran = Pengeluaran::create([
                'keterangan' => $request->keterangan,
                'jumlah' => $request->jumlah,
                'bukti_path' => $request->drive_file_id
            ]);

        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil ditambahkan');
    }
}

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
            'bukti' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048'
        ]);

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Upload to Google Drive
            Storage::disk('google')->put('1tPwW1KHcYBqHBWEv5525f26tltRAsuuV/' . $fileName, file_get_contents($file));
            $path = Storage::disk('google')->url('1tPwW1KHcYBqHBWEv5525f26tltRAsuuV/' . $fileName);

            Pengeluaran::create([
                'keterangan' => $request->keterangan,
                'jumlah' => $request->jumlah,
                'bukti_path' => $path
            ]);
        }

        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil ditambahkan');
    }
}

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
            'tanggal_pengeluaran' => 'required|date',
            'bukti' => 'required'
        ]);

        try {
            $pengeluaran = Pengeluaran::create([
                'keterangan' => $request->keterangan,
                'jumlah' => $request->jumlah,
                'tanggal_pengeluaran' => $request->tanggal_pengeluaran ?? now(),
                'bukti_path' => $request->bukti
            ]);

            return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        return view('pengeluaran.edit', compact('pengeluaran'));
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $request->validate([
            'keterangan' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal_pengeluaran' => 'required|date',
        ]);

        try {
            $data = [
                'keterangan' => $request->keterangan,
                'jumlah' => $request->jumlah,
                'tanggal_pengeluaran' => $request->tanggal_pengeluaran
            ];

            if ($request->bukti) {
                $data['bukti_path'] = $request->bukti;
            }

            $pengeluaran->update($data);
            return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        try {
            $pengeluaran->delete();
            return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}

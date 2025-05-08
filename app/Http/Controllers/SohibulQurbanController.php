<?php

namespace App\Http\Controllers;

use App\Models\SohibulQurban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SohibulQurbanController extends Controller
{
    public function index()
    {
        $qurbanData = SohibulQurban::latest()->paginate(10);
        return view('sohibul-qurban.index', compact('qurbanData'));
    }

    public function create()
    {
        return view('sohibul-qurban.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sohibul' => 'required|string|max:255',
            'qurban_untuk' => 'nullable|string|max:255',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'alamat' => 'nullable|string',
            'nomor_telepon' => 'nullable|string|max:20',
            'status_pembayaran' => 'required|in:belum_bayar,sudah_bayar,titip_panitia',
            'metode_pembayaran' => 'nullable|required_if:status_pembayaran,sudah_bayar|in:tunai,transfer',
            'bukti_transfer' => 'nullable|required_if:metode_pembayaran,transfer',
            'jenis_hewan' => 'required|in:sapi,kambing',
            'is_collective' => 'required_if:jenis_hewan,sapi|boolean',
            'catatan' => 'nullable|string',
            'drive_file_id' => 'nullable|string', // Tambah validasi untuk drive_file_id
        ]);

        if (empty($validated['qurban_untuk'])) {
            $validated['qurban_untuk'] = $validated['nama_sohibul'];
        }

        // Simpan file ID dari Google Drive jika ada
        if ($request->has('drive_file_id')) {
            $validated['bukti_transfer'] = $request->drive_file_id;
        }

        // Set metode_pembayaran to null if status is not sudah_bayar
        if ($validated['status_pembayaran'] !== 'sudah_bayar') {
            $validated['metode_pembayaran'] = null;
            $validated['bukti_transfer'] = null;
        }

        // Set is_collective to false for kambing
        if ($validated['jenis_hewan'] === 'kambing') {
            $validated['is_collective'] = false;
        }

        SohibulQurban::create($validated);
        return redirect()->route('sohibul-qurban.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(SohibulQurban $sohibulQurban)
    {
        return view('sohibul-qurban.edit', compact('sohibulQurban'));
    }

    public function update(Request $request, SohibulQurban $sohibulQurban)
    {
        $validated = $request->validate([
            'nama_sohibul' => 'required|string|max:255',
            'qurban_untuk' => 'nullable|string|max:255',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'alamat' => 'nullable|string',
            'nomor_telepon' => 'nullable|string|max:20',
            'status_pembayaran' => 'required|in:belum_bayar,sudah_bayar,titip_panitia',
            'metode_pembayaran' => 'nullable|required_if:status_pembayaran,sudah_bayar|in:tunai,transfer',
            'bukti_transfer' => 'nullable|required_if:metode_pembayaran,transfer',
            'jenis_hewan' => 'required|in:sapi,kambing',
            'is_collective' => 'required_if:jenis_hewan,sapi|boolean',
            'catatan' => 'nullable|string',
        ]);

        if (empty($validated['qurban_untuk'])) {
            $validated['qurban_untuk'] = $validated['nama_sohibul'];
        }

        // Handle file upload
        if ($request->hasFile('bukti_transfer')) {
            // Delete old file if exists
            if ($sohibulQurban->bukti_transfer) {
                Storage::disk('public')->delete($sohibulQurban->bukti_transfer);
            }
            $path = $request->file('bukti_transfer')->store('transfer-proofs', 'public');
            $validated['bukti_transfer'] = $path;
        }

        // Set metode_pembayaran to null if status is not sudah_bayar
        if ($validated['status_pembayaran'] !== 'sudah_bayar') {
            $validated['metode_pembayaran'] = null;
            $validated['bukti_transfer'] = null;
            // Delete existing file if status changed from sudah_bayar
            if ($sohibulQurban->bukti_transfer) {
                Storage::disk('public')->delete($sohibulQurban->bukti_transfer);
            }
        }

        // Set is_collective to false for kambing
        if ($validated['jenis_hewan'] === 'kambing') {
            $validated['is_collective'] = false;
        }

        $sohibulQurban->update($validated);
        return redirect()->route('sohibul-qurban.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(SohibulQurban $sohibulQurban)
    {
        // Delete file if exists
        if ($sohibulQurban->bukti_transfer) {
            Storage::disk('public')->delete($sohibulQurban->bukti_transfer);
        }

        $sohibulQurban->delete();
        return redirect()->route('sohibul-qurban.index')->with('success', 'Data berhasil dihapus');
    }
}

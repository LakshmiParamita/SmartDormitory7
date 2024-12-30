<?php

namespace App\Http\Controllers;

use App\Models\Aset;  
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AsetController extends Controller
{
    /**
     * Menampilkan daftar semua aset.
     */
    public function index(Request $request)
    {
        $query = Aset::query();
        
        // Filter berdasarkan nama aset
        if ($request->has('search')) {
            $query->where('nama_aset', 'like', '%' . $request->search . '%');
        }
        
        $asets = $query->get();
        return view('aset.index', compact('asets'));
    }

    /**
     * Menampilkan form untuk menambahkan aset baru.
     */
    public function create()
    {
        return view('aset.create'); // Menampilkan form untuk tambah aset
    }

    /**
     * Menyimpan data aset baru.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim
        $validatedData = $request->validate([
            'nama_aset' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'satuan' => 'required|string|max:50',
            'jumlah' => 'required|integer',
        ]);

        // Menyimpan data aset ke database
        Aset::create($validatedData);

        return redirect()->route('asets.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu aset berdasarkan ID.
     */
    public function show($id)
    {
        $aset = Aset::findOrFail($id); // Menampilkan detail aset
        return view('aset.show', compact('aset'));
    }

    /**
     * Menampilkan form untuk mengedit data aset.
     */
    public function edit($id)
    {
        $aset = Aset::findOrFail($id); // Mengambil data aset berdasarkan ID
        return view('aset.edit', compact('aset'));
    }

    /**
     * Mengupdate data aset.
     */
    public function update(Request $request, $id)
    {
        $aset = Aset::findOrFail($id);

        // Validasi data yang dikirim
        $validatedData = $request->validate([
            'nama_aset' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'satuan' => 'required|string|max:50',
            'jumlah' => 'required|integer',
        ]);

        // Update data aset
        $aset->update($validatedData);

        return redirect()->route('asets.index')->with('success', 'Aset berhasil diperbarui.');
    }

    /**
     * Menghapus data aset.
     */
    public function destroy($id)
    {
        $aset = Aset::findOrFail($id);
        $aset->delete();

        return redirect()->route('asets.index')->with('success', 'Aset berhasil dihapus.');
    }

    // Tambahkan method baru untuk generate PDF
    public function generatePDF(Request $request)
    {
        try {
            $query = Aset::query();
            
            if ($request->has('selected_ids')) {
                $selectedIds = explode(',', $request->selected_ids);
                $query->whereIn('id', $selectedIds);
            }
            
            $asets = $query->get();
            
            if ($asets->isEmpty()) {
                return back()->with('error', 'Tidak ada data yang dipilih');
            }
            
            $pdf = Pdf::loadView('aset.pdf', compact('asets'));
            return $pdf->setPaper('a4', 'portrait')
                      ->download('daftar-aset.pdf');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat generate PDF: ' . $e->getMessage());
        }
    }
}

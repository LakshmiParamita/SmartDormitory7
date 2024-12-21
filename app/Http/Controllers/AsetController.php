<?php

namespace App\Http\Controllers;

use App\Models\Aset;  
use Illuminate\Http\Request;

class AsetController extends Controller
{
    /**
     * Menampilkan daftar semua aset.
     */
    public function index()
    {
        $asets = Aset::all(); // Mengambil semua data aset
        return view('aset.index', compact('asets')); // Menampilkan view aset.index
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
}

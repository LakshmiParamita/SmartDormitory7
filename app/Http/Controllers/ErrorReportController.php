<?php

namespace App\Http\Controllers;

use App\Models\ErrorReport;
use Illuminate\Http\Request;

class ErrorReportController extends Controller
{
    /**
     * Menampilkan daftar gedung.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $buildings = collect([
            ...array_map(fn($i) => "Gedung $i", range(1, 12)),
            ...array_map(fn($letter) => "Gedung $letter", range('A', 'F')),
        ]);

        return view('error_reports.index', compact('buildings'));
    }

    /**
     * Menampilkan laporan error untuk gedung tertentu.
     *
     * @param  string  $buildingName
     * @return \Illuminate\View\View
     */
    public function show($buildingName)
    {
        $errorReports = ErrorReport::where('building_name', $buildingName)->get();

        return view('error_reports.show', compact('buildingName', 'errorReports'));
    }

    /**
     * Menampilkan form untuk membuat laporan error baru.
     *
     * @param  string  $buildingName
     * @return \Illuminate\View\View
     */
    public function create($buildingName)
    {
        return view('error_reports.create', compact('buildingName'));
    }

    /**
     * Menyimpan laporan error baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $buildingName
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $buildingName)
    {
        // Validasi input
        $validated = $request->validate([
            'error_title' => 'required|max:255',
            'error_description' => 'required',
        ]);

        // Simpan laporan baru
        ErrorReport::create([
            'building_name' => $buildingName,
            'error_title' => $validated['error_title'],
            'error_description' => $validated['error_description'],
        ]);

        return redirect()->route('error_reports.show', $buildingName)
            ->with('success', 'Laporan error berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit laporan error.
     *
     * @param  string  $buildingName
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($buildingName, $id)
    {
        $errorReport = ErrorReport::findOrFail($id);

        return view('error_reports.edit', compact('buildingName', 'errorReport'));
    }

    /**
     * Memperbarui laporan error yang ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $buildingName
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $buildingName, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'error_title' => 'required|max:255',
            'error_description' => 'required',
        ]);

        // Temukan laporan dan perbarui
        $errorReport = ErrorReport::findOrFail($id);
        $errorReport->update($validated);

        return redirect()->route('error_reports.show', $buildingName)
            ->with('success', 'Laporan error berhasil diperbarui.');
    }

    /**
     * Menghapus laporan error.
     *
     * @param  string  $buildingName
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($buildingName, $id)
    {
        $errorReport = ErrorReport::findOrFail($id);
        $errorReport->delete();

        return redirect()->route('error_reports.show', $buildingName)
            ->with('success', 'Laporan error berhasil dihapus.');
    }
}

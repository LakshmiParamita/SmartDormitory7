<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ErrorReport;

class StaffErrorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Menampilkan laporan error untuk gedung tertentu.
     *
     * @param  string  $buildingName
     * @return \Illuminate\View\View
     */
    public function show($buildingName)
    {
        $errorReports = \App\Models\ErrorReport::where('building_name', $buildingName)
                                             ->orderBy('created_at', 'desc')
                                             ->get();
        
        return view('staff.error', compact('buildingName', 'errorReports'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $errorReport = ErrorReport::findOrFail($id);
            $errorReport->status = $request->status;
            $errorReport->save();

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status'
            ], 500);
        }
    }
}

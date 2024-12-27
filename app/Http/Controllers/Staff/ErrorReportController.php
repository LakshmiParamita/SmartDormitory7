<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ErrorReport;
use Illuminate\Http\Request;

class ErrorReportController extends Controller
{
    public function show($buildingName)
    {
        $errorReports = ErrorReport::where('building_name', $buildingName)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('staff.error_reports.show', [
            'buildingName' => $buildingName,
            'errorReports' => $errorReports
        ]);
    }

    public function updateStatus(Request $request, ErrorReport $errorReport)
    {
        $request->validate([
            'status' => 'required|in:Diajukan,Diproses,Selesai',
        ]);

        $errorReport->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
} 
<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Lamp;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    public function index()
    {
        $gedungs = Gedung::all();
        return view('gedungs.index', compact('gedungs'));
    }

    public function create()
    {
        return view('gedungs.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Gedung::create($request->all());
        return redirect()->route('gedungs.index')->with('success', 'Gedung berhasil ditambahkan.');
    }

    public function destroy(Gedung $gedung)
    {
        $gedung->delete();
        return redirect()->route('gedungs.index')->with('success', 'Gedung berhasil dihapus.');
    }

    public function show($id)
    {
        $gedung = Gedung::findOrFail($id);
        $lamps = $gedung->lamps;
        return view('gedungs.show', compact('gedung', 'lamps'));
    }

    public function toggleLamp(Request $request, $id)
    {
        $lamp = Lamp::findOrFail($id);
        $lamp->is_on = !$lamp->is_on;
        $lamp->save();

        return response()->json(['success' => true, 'is_on' => $lamp->is_on]);
    }

    public function turnAllOn(Gedung $gedung)
    {
        $gedung->lamps()->update(['is_on' => true]);
        
        return response()->json([
            'success' => true
        ]);
    }

    public function setSchedule(Request $request, Gedung $gedung)
    {
        $request->validate([
            'time_on' => 'required|date_format:H:i',
            'time_off' => 'required|date_format:H:i'
        ]);

        // Simpan jadwal ke database
        $gedung->update([
            'schedule_on' => $request->time_on,
            'schedule_off' => $request->time_off
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function turnAllOff(Gedung $gedung)
    {
        $gedung->lamps()->update(['is_on' => false]);
        
        return response()->json([
            'success' => true
        ]);
    }

    public function dashboard()
    {
        // Logika untuk menampilkan data di dashboard
        return view('dashboard'); // Pastikan Anda membuat view dashboard.blade.php
    }

    public function addLamp(Request $request, $gedungId)
    {
        try {
            $lamp = new Lamp();
            $lamp->name = $request->name;
            $lamp->gedung_id = $gedungId;
            $lamp->is_on = false;
            $lamp->save();

            return response()->json([
                'success' => true,
                'message' => 'Lampu berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteLamp(Lamp $lamp)
    {
        $lamp->delete();

        return response()->json([
            'success' => true
        ]);
    }
}

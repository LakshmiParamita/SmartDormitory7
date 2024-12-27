<?php

namespace App\Http\Controllers;

use App\Models\BuildingLock;
use App\Models\Gedung;
use Illuminate\Http\Request;

class BuildingLockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buildings = Gedung::with('buildingLock')->get();
        // Untuk debugging
        // dd($buildings);
        return view('smartlock.show', compact('buildings'));
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    public function toggleLock(string $id)
    {
        $buildingLock = BuildingLock::where('gedung_id', $id)->first();
        
        if (!$buildingLock) {
            $buildingLock = BuildingLock::create([
                'gedung_id' => $id,
                'is_locked' => true
            ]);
        } else {
            $buildingLock->update([
                'is_locked' => !$buildingLock->is_locked
            ]);
        }

        return response()->json([
            'status' => 'success',
            'is_locked' => $buildingLock->is_locked
        ]);
    }

    public function lockAll()
    {
        // Update semua gedung yang belum terkunci
        $buildings = Gedung::all();
        
        foreach ($buildings as $building) {
            $buildingLock = BuildingLock::where('gedung_id', $building->id)->first();
            
            if (!$buildingLock) {
                BuildingLock::create([
                    'gedung_id' => $building->id,
                    'is_locked' => true
                ]);
            } else {
                $buildingLock->update([
                    'is_locked' => true
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'All buildings have been locked'
        ]);
    }

    public function unlockAll()
    {
        $buildings = Gedung::all();
        
        foreach ($buildings as $building) {
            $buildingLock = BuildingLock::where('gedung_id', $building->id)->first();
            
            if (!$buildingLock) {
                BuildingLock::create([
                    'gedung_id' => $building->id,
                    'is_locked' => false
                ]);
            } else {
                $buildingLock->update([
                    'is_locked' => false
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'All buildings have been unlocked'
        ]);
    }
}

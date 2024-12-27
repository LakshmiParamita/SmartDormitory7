<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Water;
use App\Http\Requests\StoreWaterRequest;
use App\Http\Requests\UpdateWaterRequest;

class WaterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        
        $waters = Water::all();
        return view('water.index')->with('waters', $waters);
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function getCreateForm()
    {
        return view('water.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWaterRequest $request)
    {
        $validated = $request->validate([
            'kode_sensor' => 'required|unique:waters|max:4',
            'nama_gedung' => 'required',
            'kualitas_air'=> 'required|in:Bersih,Keruh,Kotor'
        ]);

        Water::create($validated);
        return redirect()->route('water.index')->with('success', 'Monitoring berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Water $water)
    {
        $nav = 'Detail Monitor' . $water->id;
        // Tambahkan debugging
        \Log::info('Kualitas Air: ' . $water->kualitas_air);
        \Log::info('Kondisi Kotor: ' . ($water->kualitas_air == 'Kotor' ? 'true' : 'false'));
        \Log::info('Kondisi Keruh: ' . ($water->kualitas_air == 'Keruh' ? 'true' : 'false'));
    
        return view('water.show', compact('water', 'nav'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getEditForm(Water $water)
    {
        $nav = 'Edit Monitor' . $water->id;
        return view('water.edit', compact('water', 'nav'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWaterRequest $request, Water $water)
    {
        $validated = $request->validate([
            'kode_sensor' => 'required|unique:waters,kode_sensor,'.$water->id.'|max:4',
            'nama_gedung' => 'required',
            'kualitas_air'=> 'required|in:Bersih,Keruh,Kotor'
        ]);

        $water->update($validated);
        return redirect()->route('water.index')->with('success', 'Monitor berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Water $water)
    {
        $water->delete();
        return redirect()->route('water.index')->with('success','Monitor berhasil dihapus');
    }
    
    public function buangAir($id)
    {
        try {
            $water = Water::findOrFail($id);
            
            if($water->kualitas_air == 'Kotor') {
                $water->kualitas_air = 'Bersih';
                $water->save();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Air berhasil dibuang dan diganti dengan air bersih',
                    'kualitas_air' => $water->kualitas_air
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Air tidak dalam kondisi kotor'
            ]);
                
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function filterAir($id)
    {
        try {
            $water = Water::findOrFail($id);
            
            if($water->kualitas_air == 'Keruh') {
                $water->kualitas_air = 'Bersih';
                $water->save();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Air berhasil difilter menjadi bersih',
                    'kualitas_air' => $water->kualitas_air
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Air tidak dalam kondisi keruh'
            ]);
                
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}
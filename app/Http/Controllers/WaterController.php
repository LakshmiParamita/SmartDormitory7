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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_sensor' => 'required|unique:waters|max:4',
            'nama_gedung' => 'required',
            'kualitas_air' => 'required|in:Bersih,Keruh,Kotor',
            'tekanan_air' => 'required|numeric'
        ]);

        // Hitung debit menggunakan konstanta
        $debit = Water::DEFAULT_VELOCITY * Water::DEFAULT_WIDTH * $validated['tekanan_air'];

        $water = Water::create([
            'kode_sensor' => $validated['kode_sensor'],
            'nama_gedung' => $validated['nama_gedung'],
            'kualitas_air' => $validated['kualitas_air'],
            'debit' => $debit,
            'tekanan_air' => $validated['tekanan_air']
        ]);
        
        if ($water->cekKebocoran()) {
            return redirect()->route('water.index')
                ->with('warning', 'Monitor berhasil ditambahkan, tetapi terdeteksi potensi kebocoran!')
                ->with('success', 'Monitoring berhasil ditambahkan');
        }

        return redirect()->route('water.index')
            ->with('success', 'Monitoring berhasil ditambahkan');
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
    public function update(Request $request, Water $water)
    {
        $validated = $request->validate([
            'kode_sensor' => 'required|unique:waters,kode_sensor,'.$water->id.'|max:4',
            'nama_gedung' => 'required',
            'kualitas_air' => 'required|in:Bersih,Keruh,Kotor',
            'tekanan_air' => 'required|numeric'
        ]);

        $debit = Water::DEFAULT_VELOCITY * Water::DEFAULT_WIDTH * $validated['tekanan_air'];

        $water->update([
            'kode_sensor' => $validated['kode_sensor'],
            'nama_gedung' => $validated['nama_gedung'],
            'kualitas_air' => $validated['kualitas_air'],
            'debit' => $debit,
            'tekanan_air' => $validated['tekanan_air']
        ]);
        
        if ($water->cekKebocoran()) {
            return redirect()->route('water.index')
                ->with('warning', 'Monitor berhasil diupdate, tetapi terdeteksi potensi kebocoran!')
                ->with('success', 'Monitor berhasil diupdate');
        }
        
        return redirect()->route('water.index')
            ->with('success', 'Monitor berhasil diupdate');
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

    public function panggilTeknisi($id)
    {
        try {
            $water = Water::findOrFail($id);
            
            if ($water->panggilTeknisi()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Teknisi telah dipanggil untuk menangani kebocoran di ' . $water->nama_gedung
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada kebocoran yang perlu ditangani atau sudah dalam penanganan'
            ]);
                
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function selesaiPenanganan($id)
    {
        try {
            $water = Water::findOrFail($id);
            
            if ($water->selesaiPenanganan()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Penanganan selesai dan sistem kembali normal di ' . $water->nama_gedung
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menyelesaikan penanganan'
            ]);
                
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function cekPompa($id)
    {
        try {
            $water = Water::findOrFail($id);
            
            if ($water->cekPompaAir()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Status pengecekan pompa air telah diaktifkan untuk ' . $water->nama_gedung
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat mengaktifkan status pengecekan pompa'
            ]);
                
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function selesaiCekPompa($id)
    {
        try {
            $water = Water::findOrFail($id);
            
            if ($water->selesaiCekPompa()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pengecekan pompa selesai dan tekanan air kembali normal di ' . $water->nama_gedung
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menyelesaikan pengecekan pompa'
            ]);
                
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}
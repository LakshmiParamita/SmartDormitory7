<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnlockingRecord;

class UnlockingRecordController extends Controller
{
    public function store(Request $request)
    {
        // Ambil gambar dari webcam/kamera (contoh menggunakan base64)
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->input('image')));
        
        UnlockingRecord::create([
            'timestamp' => now(),
            'activity' => 'Pintu dikunci',
            'image' => $image
        ]);

        return redirect()->route('unlocking_records.index');
    }
}

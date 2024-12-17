<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        // Menampilkan semua video
        $videos = Video::all();
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        // Menampilkan form upload video
        return view('videos.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,avi,flv|max:20480' // Max 20 MB
        ]);

        // Upload video
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');

            // Simpan ke database
            Video::create([
                'title' => $request->title,
                'video_path' => $videoPath
            ]);

            return redirect()->route('videos.index')->with('success', 'Video berhasil diunggah!');
        }

        return back()->with('error', 'Gagal mengunggah video');
    }

    public function show($id)
    {
        // Menampilkan video
        $video = Video::findOrFail($id);
        return view('videos.show', compact('video'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'videos.*' => 'required|mimes:mp4,mov,avi,flv|max:20480' // Max 20 MB per file
        ]);

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $videoPath = $video->store('videos', 'public');

                Video::create([
                    'title' => $request->title,
                    'video_path' => $videoPath
                ]);
            }

            return redirect()->route('videos.index')->with('success', 'Videos successfully uploaded!');
        }

        return back()->with('error', 'Failed to upload videos');
    }

    public function show($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.show', compact('video'));
    }
}
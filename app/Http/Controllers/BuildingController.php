<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;

class BuildingController extends Controller
{
    public function index()
    {
        $buildings = Building::all();
        return view('buildings.index', compact('buildings'));
    }

    public function create()
    {
        return view('buildings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'floor' => 'required|integer',
            'cctv_url_right' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:20000',
            'cctv_url_left' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        $cctvUrlRight = null;
        $cctvUrlLeft = null;

        if ($request->hasFile('cctv_url_right')) {
            $cctvUrlRight = $request->file('cctv_url_right')->store('cctv_videos', 'public');
        }

        if ($request->hasFile('cctv_url_left')) {
            $cctvUrlLeft = $request->file('cctv_url_left')->store('cctv_videos', 'public');
        }

        Building::create([
            'name' => $request->name,
            'floor' => $request->floor,
            'cctv_url_right' => $cctvUrlRight,
            'cctv_url_left' => $cctvUrlLeft,
        ]);

        return redirect()->route('buildings.index')->with('success', 'Building created successfully.');
    }

    public function show($id)
    {
        $building = Building::findOrFail($id);
        return view('buildings.show', compact('building'));
    }

    public function edit($id)
    {
        $building = Building::findOrFail($id);
        return view('buildings.edit', compact('building'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'floor' => 'required|integer',
            'cctv_url_right' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:20000',
            'cctv_url_left' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        $building = Building::findOrFail($id);

        if ($request->hasFile('cctv_url_right')) {
            $cctvUrlRight = $request->file('cctv_url_right')->store('cctv_videos', 'public');
            $building->cctv_url_right = $cctvUrlRight;
        }

        if ($request->hasFile('cctv_url_left')) {
            $cctvUrlLeft = $request->file('cctv_url_left')->store('cctv_videos', 'public');
            $building->cctv_url_left = $cctvUrlLeft;
        }

        $building->name = $request->name;
        $building->floor = $request->floor;
        $building->save();

        return redirect()->route('buildings.index')->with('success', 'Building updated successfully.');
    }

    public function destroy($id)
    {
        $building = Building::findOrFail($id);
        $building->delete();

        return redirect()->route('buildings.index')->with('success', 'Building deleted successfully.');
    }
}
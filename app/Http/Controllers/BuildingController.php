<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;

class BuildingController extends Controller
{
    public function index()
    {
        $buildings = Building::all();
        return view('dashboard', compact('buildings'));
        return view('building.index', compact('buildings'));
    }
}


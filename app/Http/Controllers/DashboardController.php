<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if($user->usertype === 'penghuni') {
            return view('penghuni.dashboard', compact('user'));
        }
        
        return view('dashboard', compact('user'));
    }
} 
<?php

namespace App\Http\Controllers;

use App\Models\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login.login'); 
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = UserLogin::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Login pengguna
            Auth::login($user);
            return redirect()->route('home'); // nanti yang home ganti jadi nama dashboarnya ya ar
        }

        return back()->withErrors([
            'username' => 'The provided credentials are incorrect.',
        ]);
    }

    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('login.register'); 
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:userlogin,username',
            'password' => 'required|confirmed',
        ]);

        // Membuat user baru
        UserLogin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    // Menampilkan halaman home (nanti tergantung kamu namain dashboardnya apa)
    public function index()
    {
        return view('home'); // nanti yang home ganti jadi nama dashboarnya ya ar
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

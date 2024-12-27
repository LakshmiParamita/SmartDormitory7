<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Menampilkan halaman registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        }

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password), 
        ]);

        return redirect('login')->with('success', 'Registration successful! Please login.');
    }
}

<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Requests\Siswa\Login;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.student');
    }

    public function authenticate(Login $request)
    {   
        $credentials = $request->only('nisn', 'password');
        $credentials['role'] = 'siswa';

        // Condition
        if (Auth::attempt($credentials)) {

            // Generate Session
            $request->session()->regenerate();

            return redirect()->route('siswa.dashboard');
        } else {
            // Return back with message error
            return back()->withErrors([
                'credentials' => 'Your Credentials are wrong'
            ])->withInput();
        }
    }
}

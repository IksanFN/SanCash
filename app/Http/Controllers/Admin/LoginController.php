<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Login as AdminLogin;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.admin');
    }

    public function loginAdmin(AdminLogin $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['role'] = 'admin';

        // Condition check
        if (Auth::attempt($credentials)) {
            // Generate Session
            $request->session()->regenerate();

            // Redirect
            return redirect()->route('admin.dashboard');
        } else {
            return back()->withErrors([
                'credentials' => 'Your Credentials are wrong'
            ])->withInput();
        }
    }

    public function logoutAdmin(Request $request)
    {
        // Logic logout
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}

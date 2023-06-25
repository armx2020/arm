<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {

        if (Auth::guard('admin')->attempt([
            'login'    => $request->get('login'),
            'password' => $request->get('password')
        ], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('status', 'Incorrect login or password')->onlyInput('login');;
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}

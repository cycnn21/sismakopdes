<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Menampilkan halaman login
    |--------------------------------------------------------------------------
    */

    public function admin()
    {
        return view('auth.admin-login');
    }

    public function user()
    {
        return view('auth.user-login');
    }

    /*
|--------------------------------------------------------------------------
| Register User
|--------------------------------------------------------------------------
*/

public function register()
{
    return view('auth.register');
}

public function storeRegister(Request $request)
{
    $request->validate([
        'name' => 'required|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user',
    ]);

    return redirect()
        ->route('login.user')
        ->with('success', 'Registrasi berhasil. Silakan login.');
}

    /*
    |--------------------------------------------------------------------------
    | Login Admin
    |--------------------------------------------------------------------------
    */

    public function authenticateAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if (Auth::user()->role != 'admin') {

                Auth::logout();

                return back()->withErrors([
                    'email' => 'Akun ini bukan Administrator.'
                ]);

            }

            return redirect()->route('admin.dashboard');

        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Login User
    |--------------------------------------------------------------------------
    */

    public function authenticateUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if (Auth::user()->role != 'user') {

                Auth::logout();

                return back()->withErrors([
                    'email' => 'Silakan login melalui halaman User.'
                ]);

            }

            return redirect()->route('user.dashboard');

        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
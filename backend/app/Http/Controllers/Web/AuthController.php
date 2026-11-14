<?php

namespace App\Http\Controllers\Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showLogin()
{
    return view('auth.login');
}

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (! Auth::attempt($credentials)) {
        return back()->withErrors(['email' => 'Invalid email or password'])->onlyInput('email');
    }

    if (Auth::user()->status != 1) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return back()->withErrors(['email' => 'Your account is not approved yet'])->onlyInput('email');
    }

    $request->session()->regenerate();

    $paths = [1 => '/admin', 2 => '/vendor', 3 => '/shop'];
    return redirect($paths[Auth::user()->role]);
}
public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}

public function showRegister()
{
    return view('auth.register');
}

public function register(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:2,3',
        'business_name' => 'required|string|max:255',
    ]);

    DB::transaction(function () use ($data) {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $data['role'],
            'status' => 0,
        ]);

        if ($data['role'] == 2) {
            $user->vendor()->create(['warehouse_name' => $data['business_name']]);
        } else {
            $user->shop()->create(['shop_name' => $data['business_name']]);
        }
    });

    return redirect('/login')->with('success', 'Registered. Please wait for admin approval.');
}

}

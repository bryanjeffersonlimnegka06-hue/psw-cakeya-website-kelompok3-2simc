<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form
     */
    public function showLoginForm()
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return redirect('/admin/panel');
        }
        return view('Admin-Panel.login.login-form');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        $user = User::where('name', $validated['username'])->first();

        if (!$user || !$this->passwordMatches($user, $validated['password'])) {
            return back()->with('error', 'Invalid credentials.');
        }

        if (!$user->is_admin) {
            return back()->with('error', 'Unauthorized access. You do not have admin permissions.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/admin/panel')->with('success', 'Login successful!');
    }

    private function passwordMatches(User $user, string $password): bool
    {
        $storedPassword = (string) $user->getRawOriginal('password');

        if (Hash::isHashed($storedPassword)) {
            return Hash::check($password, $storedPassword);
        }

        if (hash_equals($storedPassword, $password)) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->save();

            return true;
        }

        return false;
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }
}

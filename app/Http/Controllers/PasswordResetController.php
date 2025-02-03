<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordResetController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('password.reset', [
            'token' => $token,
            'email' => $request->email,
            'title' => 'Reset Password',
            'active' => 'password.reset'
        ]);
    }

    public function reset(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:5|max:255',
    ]);

    // Temukan pengguna berdasarkan email
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email tidak ditemukan.']);
    }

    // Update password pengguna menggunakan metode update
    $user->update(['password' => Hash::make($request->password)]);

    return redirect()->route('login')->with('success', 'Password berhasil direset.');
}
}
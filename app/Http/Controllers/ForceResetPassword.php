<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ForceResetPassword extends Controller
{
    public function showForm()
    {
        return view('resetPage.index');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => ['required','confirmed',Password::min(8)->mixedCase()->symbols()->letters()->numbers()],
        ]);
        $user = User::find(Auth::user()->id);
        $newPassword = $request->password;
        $user->password = Hash::make($newPassword);
        $user->force_password_reset = 1;
        $user->save();
        Auth::logout();

        return redirect()->route('login')->with('success', 'Password has been reset. Please log in with your new password.');
    }
}

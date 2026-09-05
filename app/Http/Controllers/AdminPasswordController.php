<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminPasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('admin.ganti-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|same:konfirmasi_password_baru',
        ], [
            'password_baru.same' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->password_lama, $admin->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai']);
        }

        $admin->update([
            'password' => Hash::make($request->password_baru)
        ]);

        return redirect()->route('admin.password.change')->with('success', 'Password berhasil diubah.');
    }
}

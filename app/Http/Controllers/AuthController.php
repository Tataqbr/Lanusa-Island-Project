<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Super Admin
    public function showLoginSAdmin()
    {
        return view('super-admin.login');
    }

    public function loginSAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Ambil data super admin dari database
        $admin = DB::table('super_admin')
                    ->where('username', $request->username)
                    ->where('password', $request->password) // TANPA HASH
                    ->first();

        if ($admin) {
            // Simpan ke session
           session([
                'login_type' => 'super_admin',
                'super_admin' => [
                    'id' => $admin->id,
                    'username' => $admin->username
                ]
            ]);

            return redirect()->route('dashboard-super-admin')->with('success', 'Login berhasil.');
        } else {
            return back()->with('error', 'Username atau password salah.');
        }
    }

// Super Admin  
public function logoutSAdmin()
{
    // ✅ PERBAIKI: Gunakan forget() bukan flush()
    session()->forget(['login_type', 'super_admin']);
    
    return redirect()->route('login-super-admin')->with('success', 'Berhasil logout.');
}

// Admin
    public function showLoginAdmin()
    {
        return view('admin.login');
    }


    public function loginAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Ambil data super admin dari database
        $admin = DB::table('admins')
                    ->where('username', $request->username)
                    ->where('password', $request->password) // TANPA HASH
                    ->first();

        if ($admin) {
            // Simpan ke session
           session([
                'login_type' => 'admins',
                'admins' => [
                    'id' => $admin->id,
                    'username' => $admin->username
                ]
            ]);

            return redirect()->route('dashboard-admin')->with('success', 'Login berhasil.');
        } else {
            return back()->with('error', 'Username atau password salah.');
        }
    }

   // Admin
public function logoutAdmin()
{
    // ✅ PERBAIKI: Gunakan forget() bukan flush()
    session()->forget(['login_type', 'admins']);
    
    return redirect()->route('login-admin')->with('success', 'Berhasil logout.');
}


}

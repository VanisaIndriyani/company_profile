<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminUserController extends Controller
{
    // Tampilkan daftar user admin & manager
    public function index()
    {
        $users = User::whereIn('role', ['admin', 'manager'])->get();
        return view('superadmin.users.index', compact('users'));
    }

    // Tampilkan form tambah user
    public function create()
    {
        return view('superadmin.users.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,manager',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('users.index')->with('success', 'User berhasil ditambah!');
    }

    // Hapus user
    public function destroy(User $user)
    {
        if ($user->role === 'super_admin') {
            return redirect()->route('users.index')->with('error', 'Tidak bisa menghapus super admin!');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }

    public function resetPassword(User $user)
    {
        if ($user->role === 'super_admin') {
            return redirect()->route('users.index')->with('error', 'Tidak bisa reset password super admin!');
        }
        $newPassword = 'password123';
        $user->password = \Illuminate\Support\Facades\Hash::make($newPassword);
        $user->save();
        return redirect()->route('users.index')->with([
            'success' => 'Password user berhasil direset.',
            'reset_password' => $newPassword,
            'reset_user_id' => $user->id
        ]);
    }

    public function dashboard()
    {
        $adminCount = \App\Models\User::where('role', 'admin')->count();
        $managerCount = \App\Models\User::where('role', 'manager')->count();
        return view('superadmin.dashboard', [
            'adminCount' => $adminCount,
            'managerCount' => $managerCount
        ]);
    }
} 
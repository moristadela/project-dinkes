<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Bidang; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules as PasswordRules;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     * Mengirimkan data 'users' dan 'bidangs' ke view.
     */
    public function index()
    {
        $users = User::latest()->get();
        $bidangs = Bidang::all(); 
        return view('admin.users.index', compact('users', 'bidangs'));
    }

    /**
     * Menampilkan form untuk membuat pengguna baru.
     * Tidak diperlukan karena Anda menggunakan modal.
     */
    // public function create()
    // {
    //     // return view('admin.users.create');
    // }

    /**
     * Menyimpan pengguna baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', PasswordRules\Password::defaults()],
            'role' => ['required', 'string', Rule::in(['admin', 'user'])],
            'bidang_id' => 'required|exists:bidang,id',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'bidang_id' => $request->bidang_id,
        ]);

        return redirect()->route('admin.users.index')
                             ->with('success', 'User baru berhasil ditambahkan.');
    }
    
    /**
     * Menampilkan form untuk mengedit pengguna.
     */
    public function edit(User $user)
    {
        $bidangs = Bidang::all(); // Mengambil semua data bidang untuk form edit
        return view('admin.users.edit', compact('user', 'bidangs'));
    }

    /**
     * Memperbarui data pengguna di database.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'string', Rule::in(['admin', 'user'])],
            'password' => ['nullable', 'confirmed', PasswordRules\Password::defaults()],
            'bidang_id' => ['required', 'exists:bidang,id'],
        ]);
        
        // Update data dasar
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
            'bidang_id' => $request->bidang_id,
        ]);
        
        // Hanya update password jika kolom password diisi
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->route('admin.users.index')
                             ->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna dari database.
     */
    public function destroy(User $user)
    {
        // Pencegahan: Admin tidak bisa menghapus akunnya sendiri
        if (auth()->id() == $user->id) {
            return redirect()->route('admin.users.index')
                               ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
                             ->with('success', 'User berhasil dihapus.');
    }
}

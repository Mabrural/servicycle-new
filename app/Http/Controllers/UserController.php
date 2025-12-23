<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // jumlah data per halaman (default 10)
        $perPage = $request->get('per_page', 10);

        // keyword pencarian
        $search = $request->get('search');

        $users = User::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString(); // agar search & per_page tidak hilang saat pagination

        return view('manajemen-pengguna.index', compact('users', 'perPage', 'search'));
    }

    public function edit(User $user)
    {
        return view('manajemen-pengguna.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,customer,mitra',
            'password' => 'nullable|min:6|confirmed'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Data pengguna berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        // Optional: cegah hapus diri sendiri
        if (auth()->id() === $user->id) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna berhasil dihapus');
    }

}

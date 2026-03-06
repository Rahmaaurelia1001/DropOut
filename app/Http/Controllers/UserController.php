<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::with('kelas')->get();
        return view('user.index', compact('user'));
    }

    public function create()
    {
    $kelasTerpakai = User::where('role', 'wali_kelas')
        ->whereNotNull('id_kelas')
        ->pluck('id_kelas');

    $kelas = Kelas::whereNotIn('id_kelas', $kelasTerpakai)->get();

    return view('user.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required',
        'id_kelas' => 'nullable',
        'is_active' => 'required'
    ]);

        User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'id_kelas' => $request->role == 'wali_kelas' ? $request->id_kelas : null,
        'is_active' => $request->is_active,
    ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'Data user berhasil ditambahkan');
    }

    public function edit($id)
    {
    $user = User::findOrFail($id);

    $kelasTerpakai = User::where('role', 'wali_kelas')
        ->whereNotNull('id_kelas')
        ->where('id', '!=', $user->id)
        ->pluck('id_kelas');

    $kelas = Kelas::whereNotIn('id_kelas', $kelasTerpakai)->get();

    return view('user.edit', compact('user', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required',
        'id_kelas' => 'nullable',
        'is_active' => 'required'
    ]);

        $data = [
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'id_kelas' => $request->role == 'wali_kelas' ? $request->id_kelas : null,
        'is_active' => $request->is_active,
    ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')
            ->with('success', 'Data user berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')
            ->with('success', 'Data user berhasil dihapus');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AuditLog;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:superadmin,admin_ogi,editor,revisor,publicador,consulta',
            'is_active' => 'boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        AuditLog::record('create', 'User', $user->id, "Usuario administrativo creado: {$user->email} con rol {$user->role}");

        return redirect()->route('admin.users.index')->with('success', 'Usuario institucional registrado con éxito.');
    }

    public function edit($user)
    {
        $user = ($user instanceof User && $user->exists) ? $user : User::findOrFail($user);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $user)
    {
        $user = ($user instanceof User && $user->exists) ? $user : User::findOrFail($user);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:superadmin,admin_ogi,editor,revisor,publicador,consulta',
            'is_active' => 'boolean',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        AuditLog::record('update', 'User', $user->id, "Usuario actualizado: {$user->email}");

        return redirect()->route('admin.users.index')->with('success', 'Usuario institucional actualizado con éxito.');
    }

    public function destroy($user)
    {
        $user = ($user instanceof User && $user->exists) ? $user : User::findOrFail($user);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puede eliminar su propia cuenta de usuario activa.');
        }

        $email = $user->email;
        $id = $user->id;
        $user->delete();

        AuditLog::record('delete', 'User', $id, "Usuario eliminado: {$email}");

        return redirect()->route('admin.users.index')->with('success', 'Usuario institucional eliminado.');
    }
}

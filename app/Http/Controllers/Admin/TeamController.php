<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamMember;
use App\Models\AuditLog;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $query = TeamMember::query();

        if ($request->filled('q')) {
            $term = '%' . $request->q . '%';
            $query->where('name', 'like', $term)
                  ->orWhere('role_title', 'like', $term)
                  ->orWhere('department', 'like', $term);
        }

        $team = $query->orderBy('order')->orderBy('name')->paginate(12);

        return view('admin.team.index', compact('team'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role_title' => 'required|string|max:255',
            'role_title_en' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'bio_en' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order'] = $validated['order'] ?? (TeamMember::max('order') + 1);

        if ($request->has('remove_photo')) {
            $validated['photo_path'] = null;
        } elseif ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = 'team_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('imagenes/equipo');
            if (!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $file->move($destination, $fileName);
            $validated['photo_path'] = 'imagenes/equipo/' . $fileName;
        }

        $member = TeamMember::create($validated);

        AuditLog::record('create', 'TeamMember', $member->id, "Miembro del equipo '{$member->name}' registrado.");

        return redirect()->route('admin.team.index')->with('success', "Miembro '{$member->name}' creado exitosamente.");
    }

    public function edit($team)
    {
        $member = ($team instanceof TeamMember && $team->exists) ? $team : TeamMember::findOrFail($team);
        return view('admin.team.edit', compact('member'));
    }

    public function update(Request $request, $team)
    {
        $member = ($team instanceof TeamMember && $team->exists) ? $team : TeamMember::findOrFail($team);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role_title' => 'required|string|max:255',
            'role_title_en' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'bio_en' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? $member->order;

        if ($request->has('remove_photo')) {
            $validated['photo_path'] = null;
        } elseif ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = 'team_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('imagenes/equipo');
            if (!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $file->move($destination, $fileName);
            $validated['photo_path'] = 'imagenes/equipo/' . $fileName;
        }

        $member->update($validated);

        AuditLog::record('update', 'TeamMember', $member->id, "Miembro del equipo '{$member->name}' actualizado.");

        return redirect()->route('admin.team.index')->with('success', "Miembro '{$member->name}' actualizado exitosamente.");
    }

    public function destroy($team)
    {
        $member = ($team instanceof TeamMember && $team->exists) ? $team : TeamMember::findOrFail($team);
        $name = $member->name;
        $member->delete();

        AuditLog::record('delete', 'TeamMember', $member->id, "Miembro del equipo '{$name}' eliminado.");

        return redirect()->route('admin.team.index')->with('success', "Miembro '{$name}' eliminado correctamente.");
    }
}

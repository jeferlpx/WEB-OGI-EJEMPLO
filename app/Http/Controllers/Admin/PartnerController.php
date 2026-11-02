<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\AuditLog;
use Illuminate\Support\Facades\File;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $query = Partner::query();

        if ($request->filled('q')) {
            $term = '%' . $request->q . '%';
            $query->where('name', 'like', $term)->orWhere('description', 'like', $term);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $partners = $query->orderBy('order')->orderBy('name')->paginate(12);

        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'website_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order'] = $validated['order'] ?? (Partner::max('order') + 1);

        if ($request->has('remove_logo')) {
            $validated['logo_path'] = null;
        } elseif ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = 'partner_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('imagenes/aliados');
            if (!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $file->move($destination, $fileName);
            $validated['logo_path'] = 'imagenes/aliados/' . $fileName;
        } else {
            $validated['logo_path'] = 'imagenes/Logotipo_unalm.jpg';
        }

        $partner = Partner::create($validated);

        AuditLog::record('create', 'Partner', $partner->id, "Aliado estratégico '{$partner->name}' registrado.");

        return redirect()->route('admin.partners.index')->with('success', "Aliado '{$partner->name}' creado exitosamente.");
    }

    public function edit($partner)
    {
        $partner = ($partner instanceof Partner && $partner->exists) ? $partner : Partner::findOrFail($partner);
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, $partner)
    {
        $partner = ($partner instanceof Partner && $partner->exists) ? $partner : Partner::findOrFail($partner);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'website_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? $partner->order;

        if ($request->has('remove_logo')) {
            $validated['logo_path'] = null;
        } elseif ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = 'partner_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('imagenes/aliados');
            if (!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $file->move($destination, $fileName);
            $validated['logo_path'] = 'imagenes/aliados/' . $fileName;
        }

        $partner->update($validated);

        AuditLog::record('update', 'Partner', $partner->id, "Aliado estratégico '{$partner->name}' actualizado.");

        return redirect()->route('admin.partners.index')->with('success', "Aliado '{$partner->name}' actualizado exitosamente.");
    }

    public function destroy($partner)
    {
        $partner = ($partner instanceof Partner && $partner->exists) ? $partner : Partner::findOrFail($partner);
        $name = $partner->name;
        $partner->delete();

        AuditLog::record('delete', 'Partner', $partner->id, "Aliado estratégico '{$name}' eliminado.");

        return redirect()->route('admin.partners.index')->with('success', "Aliado '{$name}' eliminado correctamente.");
    }
}

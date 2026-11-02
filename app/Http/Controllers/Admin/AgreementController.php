<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agreement;
use App\Models\Institution;
use App\Models\AgreementType;
use App\Models\Country;
use App\Models\AuditLog;

class AgreementController extends Controller
{
    public function index(Request $request)
    {
        $query = Agreement::with(['institution.country', 'type']);

        if ($request->filled('q')) {
            $term = '%' . $request->q . '%';
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)
                  ->orWhere('code', 'like', $term)
                  ->orWhereHas('institution', function ($qi) use ($term) {
                      $qi->where('name', 'like', $term);
                  });
            });
        }

        if ($request->filled('scope')) {
            $query->where('scope', $request->scope);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('pub_status')) {
            $query->where('publication_status', $request->pub_status);
        }

        $agreements = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.agreements.index', compact('agreements'));
    }

    public function create()
    {
        $institutions = Institution::with('country')->orderBy('name')->get();
        $types = AgreementType::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();

        return view('admin.agreements.create', compact('institutions', 'types', 'countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:agreements,code',
            'institution_id' => 'required|exists:institutions,id',
            'agreement_type_id' => 'required|exists:agreement_types,id',
            'scope' => 'required|in:nacional,internacional',
            'faculty_scope' => 'nullable|string|max:255',
            'objective' => 'nullable|string',
            'signed_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:signed_at',
            'is_indefinite' => 'boolean',
            'status' => 'required|in:vigente,por_vencer,vencido,en_renovacion',
            'publication_status' => 'required|in:borrador,en_revision,aprobado,publicado,archivado',
            'file' => 'nullable|file|mimes:pdf|max:20480',
            'internal_notes' => 'nullable|string',
            'contact_unit' => 'nullable|string|max:255',
        ]);

        if ($request->has('remove_file')) {
            $validated['file_path'] = null;
        } elseif ($request->hasFile('file')) {
            $path = $request->file('file')->store('documentos', 'public');
            $validated['file_path'] = 'storage/' . $path;
        }

        $agreement = Agreement::create($validated);

        AuditLog::record('create', 'Agreement', $agreement->id, "Convenio creado: {$agreement->title} ({$agreement->code})");

        return redirect()->route('admin.agreements.index')->with('success', 'Convenio registrado exitosamente.');
    }

    public function edit($agreement)
    {
        $agreement = ($agreement instanceof Agreement && $agreement->exists) ? $agreement : Agreement::findOrFail($agreement);
        $institutions = Institution::with('country')->orderBy('name')->get();
        $types = AgreementType::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();

        return view('admin.agreements.edit', compact('agreement', 'institutions', 'types', 'countries'));
    }

    public function update(Request $request, $agreement)
    {
        $agreement = ($agreement instanceof Agreement && $agreement->exists) ? $agreement : Agreement::findOrFail($agreement);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:agreements,code,' . $agreement->id,
            'institution_id' => 'required|exists:institutions,id',
            'agreement_type_id' => 'required|exists:agreement_types,id',
            'scope' => 'required|in:nacional,internacional',
            'faculty_scope' => 'nullable|string|max:255',
            'objective' => 'nullable|string',
            'signed_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
            'is_indefinite' => 'boolean',
            'status' => 'required|in:vigente,por_vencer,vencido,en_renovacion',
            'publication_status' => 'required|in:borrador,en_revision,aprobado,publicado,archivado',
            'file' => 'nullable|file|mimes:pdf|max:20480',
            'internal_notes' => 'nullable|string',
            'contact_unit' => 'nullable|string|max:255',
        ]);

        if ($request->has('remove_file')) {
            $validated['file_path'] = null;
        } elseif ($request->hasFile('file')) {
            $path = $request->file('file')->store('documentos', 'public');
            $validated['file_path'] = 'storage/' . $path;
        }

        $agreement->update($validated);

        AuditLog::record('update', 'Agreement', $agreement->id, "Convenio actualizado: {$agreement->title}");

        return redirect()->route('admin.agreements.index')->with('success', 'Convenio actualizado exitosamente.');
    }

    public function destroy($agreement)
    {
        $agreement = ($agreement instanceof Agreement && $agreement->exists) ? $agreement : Agreement::findOrFail($agreement);
        $title = $agreement->title;
        $id = $agreement->id;
        $agreement->delete();

        AuditLog::record('delete', 'Agreement', $id, "Convenio eliminado: {$title}");

        return redirect()->route('admin.agreements.index')->with('success', 'Convenio eliminado correctamente.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Call;
use App\Models\AuditLog;

class CallController extends Controller
{
    public function index(Request $request)
    {
        $query = Call::query();

        if ($request->filled('q')) {
            $term = '%' . $request->q . '%';
            $query->where('title', 'like', $term)->orWhere('summary', 'like', $term);
        }

        if ($request->filled('type')) {
            $query->where('call_type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $calls = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.calls.index', compact('calls'));
    }

    public function create()
    {
        return view('admin.calls.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'call_type' => 'required|in:beca,movilidad,pasantia,investigacion,curso_corto',
            'target_audience' => 'required|in:estudiantes_pregrado,estudiantes_posgrado,docentes,administrativos,todos',
            'start_date' => 'nullable|date',
            'deadline_date' => 'nullable|date',
            'status' => 'required|in:abierta,proxima,cerrada',
            'publication_status' => 'required|in:borrador,en_revision,aprobado,publicado,archivado',
            'summary' => 'required|string',
            'summary_en' => 'nullable|string',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'apply_url' => 'nullable|url',
            'contact_email' => 'nullable|email',
            'is_featured' => 'boolean',
            'file' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);

        if ($request->has('remove_file')) {
            $validated['requirements_file_path'] = null;
        } elseif ($request->hasFile('file')) {
            $path = $request->file('file')->store('documentos', 'public');
            $validated['requirements_file_path'] = 'storage/' . $path;
        }

        $call = Call::create($validated);

        AuditLog::record('create', 'Call', $call->id, "Convocatoria creada: {$call->title}");

        return redirect()->route('admin.calls.index')->with('success', 'Convocatoria creada exitosamente.');
    }

    public function edit($call)
    {
        $call = ($call instanceof Call && $call->exists) ? $call : Call::findOrFail($call);
        return view('admin.calls.edit', compact('call'));
    }

    public function update(Request $request, $call)
    {
        $call = ($call instanceof Call && $call->exists) ? $call : Call::findOrFail($call);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'call_type' => 'required|in:beca,movilidad,pasantia,investigacion,curso_corto',
            'target_audience' => 'required|in:estudiantes_pregrado,estudiantes_posgrado,docentes,administrativos,todos',
            'start_date' => 'nullable|date',
            'deadline_date' => 'nullable|date',
            'status' => 'required|in:abierta,proxima,cerrada',
            'publication_status' => 'required|in:borrador,en_revision,aprobado,publicado,archivado',
            'summary' => 'required|string',
            'summary_en' => 'nullable|string',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'apply_url' => 'nullable|url',
            'contact_email' => 'nullable|email',
            'is_featured' => 'boolean',
            'file' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        if ($request->has('remove_file')) {
            $validated['requirements_file_path'] = null;
        } elseif ($request->hasFile('file')) {
            $path = $request->file('file')->store('documentos', 'public');
            $validated['requirements_file_path'] = 'storage/' . $path;
        }

        $call->update($validated);

        AuditLog::record('update', 'Call', $call->id, "Convocatoria actualizada: {$call->title}");

        return redirect()->route('admin.calls.index')->with('success', 'Convocatoria actualizada exitosamente.');
    }

    public function destroy($call)
    {
        $call = ($call instanceof Call && $call->exists) ? $call : Call::findOrFail($call);
        $title = $call->title;
        $id = $call->id;
        $call->delete();

        AuditLog::record('delete', 'Call', $id, "Convocatoria eliminada: {$title}");

        return redirect()->route('admin.calls.index')->with('success', 'Convocatoria eliminada correctamente.');
    }
}

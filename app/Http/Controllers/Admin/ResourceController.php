<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resource;
use App\Models\AuditLog;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $query = Resource::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $resources = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.resources.index', compact('resources'));
    }

    public function create()
    {
        return view('admin.resources.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'category' => 'required|in:reglamento,guia,formato,boletin,resolucion,otro',
            'target_audience' => 'required|in:estudiantes_salientes,estudiantes_entrantes,docentes,general',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'publication_status' => 'required|in:publicado,archivado',
            'file' => 'required|file|mimes:pdf,docx,xlsx|max:30720',
        ]);

        $file = $request->file('file');
        $path = $file->store('documentos', 'public');

        $validated['file_path'] = 'storage/' . $path;
        $validated['file_size_kb'] = round($file->getSize() / 1024);
        $validated['file_ext'] = strtolower($file->getClientOriginalExtension());

        $resource = Resource::create($validated);

        AuditLog::record('create', 'Resource', $resource->id, "Documento subido: {$resource->title}");

        return redirect()->route('admin.resources.index')->with('success', 'Documento registrado exitosamente.');
    }

    public function destroy($resource)
    {
        $resource = ($resource instanceof Resource && $resource->exists) ? $resource : Resource::findOrFail($resource);
        $title = $resource->title;
        $id = $resource->id;
        $resource->delete();

        AuditLog::record('delete', 'Resource', $id, "Documento eliminado: {$title}");

        return redirect()->route('admin.resources.index')->with('success', 'Documento eliminado correctamente.');
    }
}

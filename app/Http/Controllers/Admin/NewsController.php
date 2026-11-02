<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\News;
use App\Models\AuditLog;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query();

        if ($request->filled('q')) {
            $term = '%' . $request->q . '%';
            $query->where('title', 'like', $term)->orWhere('summary', 'like', $term);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $news = $query->orderBy('published_at', 'desc')->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'category' => 'required|in:convenio,movilidad,cooperacion,institucional,delegacion,evento',
            'published_at' => 'required|date',
            'summary' => 'required|string',
            'summary_en' => 'nullable|string',
            'content' => 'required|string',
            'content_en' => 'nullable|string',
            'is_featured' => 'boolean',
            'publication_status' => 'required|in:borrador,en_revision,aprobado,publicado,archivado',
            'author_name' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);

        if ($request->has('remove_image')) {
            $validated['featured_image_path'] = null;
        } elseif ($request->hasFile('image')) {
            $path = $request->file('image')->store('imagenes', 'public');
            $validated['featured_image_path'] = 'storage/' . $path;
        }

        $news = News::create($validated);

        AuditLog::record('create', 'News', $news->id, "Noticia creada: {$news->title}");

        return redirect()->route('admin.news.index')->with('success', 'Noticia publicada exitosamente.');
    }

    public function edit($news)
    {
        $news = ($news instanceof News && $news->exists) ? $news : News::findOrFail($news);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $news)
    {
        $news = ($news instanceof News && $news->exists) ? $news : News::findOrFail($news);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'category' => 'required|in:convenio,movilidad,cooperacion,institucional,delegacion,evento',
            'published_at' => 'required|date',
            'summary' => 'required|string',
            'summary_en' => 'nullable|string',
            'content' => 'required|string',
            'content_en' => 'nullable|string',
            'is_featured' => 'boolean',
            'publication_status' => 'required|in:borrador,en_revision,aprobado,publicado,archivado',
            'author_name' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->has('remove_image')) {
            $validated['featured_image_path'] = null;
        } elseif ($request->hasFile('image')) {
            $path = $request->file('image')->store('imagenes', 'public');
            $validated['featured_image_path'] = 'storage/' . $path;
        }

        $news->update($validated);

        AuditLog::record('update', 'News', $news->id, "Noticia actualizada: {$news->title}");

        return redirect()->route('admin.news.index')->with('success', 'Noticia actualizada exitosamente.');
    }

    public function destroy($news)
    {
        $news = ($news instanceof News && $news->exists) ? $news : News::findOrFail($news);
        $title = $news->title;
        $id = $news->id;
        $news->delete();

        AuditLog::record('delete', 'News', $id, "Noticia eliminada: {$title}");

        return redirect()->route('admin.news.index')->with('success', 'Noticia eliminada correctamente.');
    }
}

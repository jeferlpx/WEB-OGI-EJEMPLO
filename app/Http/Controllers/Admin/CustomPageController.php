<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CustomPage;
use App\Models\AuditLog;
use Illuminate\Support\Facades\File;

class CustomPageController extends Controller
{
    public function index(Request $request)
    {
        $query = CustomPage::query();

        if ($request->filled('q')) {
            $term = '%' . $request->q . '%';
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)
                  ->orWhere('title_en', 'like', $term)
                  ->orWhere('summary', 'like', $term)
                  ->orWhere('slug', 'like', $term);
            });
        }

        if ($request->filled('section')) {
            $query->where('nav_section', $request->section);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $pages = $query->orderBy('nav_section')->orderBy('order')->orderBy('id', 'desc')->paginate(20);
        $sections = CustomPage::$navSections;

        return view('admin.pages.index', compact('pages', 'sections'));
    }

    public function create()
    {
        $sections = CustomPage::$navSections;
        $nextOrder = ((int)CustomPage::max('order')) + 1;
        return view('admin.pages.create', compact('sections', 'nextOrder'));
    }

    public function store(Request $request)
    {
        $type = $request->input('type', 'page');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:custom_pages,slug',
            'type' => 'nullable|string|in:page,link,button',
            'nav_section' => 'required|string|max:100',
            'parent_section' => 'nullable|string|max:100',
            'summary' => 'nullable|string|max:1000',
            'summary_en' => 'nullable|string|max:1000',
            'content' => $type === 'page' ? 'required|string' : 'nullable|string',
            'content_en' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,zip,xls,xlsx|max:30720',
            'external_url' => 'nullable|string|max:500',
            'badge' => 'nullable|string|max:50',
            'badge_en' => 'nullable|string|max:50',
            'button_style' => 'nullable|string|max:50',
            'open_in_new_tab' => 'nullable|boolean',
            'show_in_nav' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug ?: 'pagina-' . time();
            $count = 1;
            while (CustomPage::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }
            $validated['slug'] = $slug;
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $validated['type'] = $type;
        $validated['show_in_nav'] = $request->has('show_in_nav');
        $validated['is_published'] = $request->has('is_published');
        $validated['open_in_new_tab'] = $request->has('open_in_new_tab');
        $validated['order'] = $validated['order'] ?? 0;

        if ($request->hasFile('featured_image')) {
            $img = $request->file('featured_image');
            $fileName = 'page_' . time() . '_' . Str::random(6) . '.' . $img->getClientOriginalExtension();
            $dest = public_path('imagenes/redes');
            if (!File::isDirectory($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $img->move($dest, $fileName);
            $validated['featured_image_path'] = 'imagenes/redes/' . $fileName;
        }

        if ($request->hasFile('banner_image')) {
            $img = $request->file('banner_image');
            $fileName = 'banner_page_' . time() . '_' . Str::random(6) . '.' . $img->getClientOriginalExtension();
            $dest = public_path('imagenes/portadas');
            if (!File::isDirectory($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $img->move($dest, $fileName);
            $validated['banner_image_path'] = 'imagenes/portadas/' . $fileName;
        }

        if ($request->hasFile('document_file')) {
            $doc = $request->file('document_file');
            $cleanName = Str::slug(pathinfo($doc->getClientOriginalName(), PATHINFO_FILENAME));
            $fileName = $cleanName . '_' . time() . '.' . $doc->getClientOriginalExtension();
            $dest = public_path('documentos');
            if (!File::isDirectory($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $doc->move($dest, $fileName);
            $validated['file_path'] = 'documentos/' . $fileName;
        }

        $page = CustomPage::create($validated);

        AuditLog::record('create', 'CustomPage', $page->id, "Módulo / Página creada: {$page->title} ({$page->slug}) [Sección: {$page->nav_section}]");

        return redirect()->route('admin.pages.index')->with('success', "Módulo o página \"{$page->title}\" creado con éxito.");
    }

    public function edit(CustomPage $page)
    {
        $sections = CustomPage::$navSections;
        return view('admin.pages.edit', compact('page', 'sections'));
    }

    public function update(Request $request, CustomPage $page)
    {
        $type = $request->input('type', $page->type ?? 'page');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:custom_pages,slug,' . $page->id,
            'type' => 'nullable|string|in:page,link,button',
            'nav_section' => 'required|string|max:100',
            'parent_section' => 'nullable|string|max:100',
            'summary' => 'nullable|string|max:1000',
            'summary_en' => 'nullable|string|max:1000',
            'content' => $type === 'page' ? 'required|string' : 'nullable|string',
            'content_en' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,zip,xls,xlsx|max:30720',
            'external_url' => 'nullable|string|max:500',
            'badge' => 'nullable|string|max:50',
            'badge_en' => 'nullable|string|max:50',
            'button_style' => 'nullable|string|max:50',
            'open_in_new_tab' => 'nullable|boolean',
            'show_in_nav' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $validated['type'] = $type;
        $validated['show_in_nav'] = $request->has('show_in_nav');
        $validated['is_published'] = $request->has('is_published');
        $validated['open_in_new_tab'] = $request->has('open_in_new_tab');
        $validated['order'] = $validated['order'] ?? 0;

        if ($request->has('remove_featured_image')) {
            $validated['featured_image_path'] = null;
        } elseif ($request->hasFile('featured_image')) {
            $img = $request->file('featured_image');
            $fileName = 'page_' . time() . '_' . Str::random(6) . '.' . $img->getClientOriginalExtension();
            $dest = public_path('imagenes/redes');
            if (!File::isDirectory($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $img->move($dest, $fileName);
            $validated['featured_image_path'] = 'imagenes/redes/' . $fileName;
        }

        if ($request->has('remove_banner_image')) {
            $validated['banner_image_path'] = null;
        } elseif ($request->hasFile('banner_image')) {
            $img = $request->file('banner_image');
            $fileName = 'banner_page_' . time() . '_' . Str::random(6) . '.' . $img->getClientOriginalExtension();
            $dest = public_path('imagenes/portadas');
            if (!File::isDirectory($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $img->move($dest, $fileName);
            $validated['banner_image_path'] = 'imagenes/portadas/' . $fileName;
        }

        if ($request->has('remove_document_file')) {
            $validated['file_path'] = null;
        } elseif ($request->hasFile('document_file')) {
            $doc = $request->file('document_file');
            $cleanName = Str::slug(pathinfo($doc->getClientOriginalName(), PATHINFO_FILENAME));
            $fileName = $cleanName . '_' . time() . '.' . $doc->getClientOriginalExtension();
            $dest = public_path('documentos');
            if (!File::isDirectory($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $doc->move($dest, $fileName);
            $validated['file_path'] = 'documentos/' . $fileName;
        }

        $page->update($validated);

        AuditLog::record('update', 'CustomPage', $page->id, "Módulo / Página actualizada: {$page->title} ({$page->slug})");

        return redirect()->route('admin.pages.index')->with('success', "Módulo o página \"{$page->title}\" actualizada correctamente.");
    }

    public function destroy(CustomPage $page)
    {
        $title = $page->title;
        $id = $page->id;
        $page->delete();

        AuditLog::record('delete', 'CustomPage', $id, "Módulo / Página eliminada: {$title}");

        return redirect()->route('admin.pages.index')->with('success', "Módulo \"{$title}\" eliminado exitosamente.");
    }
}

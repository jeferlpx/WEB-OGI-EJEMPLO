<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\AuditLog;
use App\Models\BannerImage;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::orderBy('group')->get()->groupBy('group');

        // Escanear videos existentes en public/videos/
        $existingVideos = [];
        $videoDir = public_path('videos');
        if (File::isDirectory($videoDir)) {
            $files = File::files($videoDir);
            foreach ($files as $file) {
                $ext = strtolower($file->getExtension());
                if (in_array($ext, ['mp4', 'webm', 'mov'])) {
                    $existingVideos[] = [
                        'filename' => $file->getFilename(),
                        'path' => 'videos/' . $file->getFilename(),
                        'size_mb' => round($file->getSize() / (1024 * 1024), 2),
                        'modified_at' => date('d/m/Y H:i', $file->getMTime()),
                    ];
                }
            }
        }

        // Ordenar por fecha más reciente
        usort($existingVideos, fn($a, $b) => strcmp($b['filename'], $a['filename']));

        // Obtener galería de fotos de portada y carrusel
        $bannerImages = BannerImage::ordered()->get();

        return view('admin.settings.index', compact('settings', 'existingVideos', 'bannerImages'));
    }

    /**
     * Subida AJAX directa de video con respuesta JSON y auto-enlace
     */
    public function uploadVideoAjax(Request $request)
    {
        try {
            $request->validate([
                'video_file' => 'required|file|mimes:mp4,webm|max:102400',
            ]);

            $video = $request->file('video_file');
            if (!$video || !$video->isValid()) {
                return response()->json([
                    'success' => false,
                    'message' => 'El archivo no es válido o la transferencia fue interrumpida.',
                ], 400);
            }

            $fileName = 'hero_video_' . time() . '.' . $video->getClientOriginalExtension();
            $destination = public_path('videos');
            if (!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $video->move($destination, $fileName);

            $path = 'videos/' . $fileName;

            // Enlazar y activar automáticamente
            SiteSetting::updateOrCreate(
                ['key' => 'hero_video_path'],
                ['value' => $path, 'group' => 'hero', 'type' => 'text']
            );
            SiteSetting::updateOrCreate(
                ['key' => 'hero_media_type'],
                ['value' => 'video', 'group' => 'hero', 'type' => 'text']
            );

            AuditLog::record('upload', 'SiteSetting', null, "Video de portada subido y enlazado automáticamente: {$path}");

            return response()->json([
                'success' => true,
                'path' => $path,
                'filename' => $fileName,
                'url' => asset($path),
                'size_mb' => round(filesize($destination . '/' . $fileName) / (1024 * 1024), 2),
                'message' => '¡Video subido y enlazado automáticamente con éxito!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $ve) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación: ' . implode(', ', $ve->validator->errors()->all()),
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la subida: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Selección y activación rápida de un video ya existente en el servidor
     */
    public function selectVideo(Request $request)
    {
        $path = trim((string)($request->input('path') ?? $request->input('video_path')));
        if (empty($path)) {
            return response()->json([
                'success' => false,
                'message' => 'Debe especificar la ruta del video.'
            ], 422);
        }
        SiteSetting::updateOrCreate(
            ['key' => 'hero_video_path'],
            ['value' => $path, 'group' => 'hero', 'type' => 'text']
        );
        SiteSetting::updateOrCreate(
            ['key' => 'hero_media_type'],
            ['value' => 'video', 'group' => 'hero', 'type' => 'text']
        );

        AuditLog::record('update', 'SiteSetting', null, "Video de portada seleccionado y activado: {$path}");

        return response()->json([
            'success' => true,
            'path' => $path,
            'message' => 'Video seleccionado y activado correctamente en la portada.',
        ]);
    }

    /**
     * Subida AJAX de fotografía oficial de portada
     */
    public function uploadBannerAjax(Request $request)
    {
        try {
            $request->validate([
                'image_file' => 'required|image|mimes:jpeg,png,jpg,webp|max:15360',
                'title' => 'nullable|string|max:255',
            ]);

            $image = $request->file('image_file');
            if (!$image || !$image->isValid()) {
                return response()->json([
                    'success' => false,
                    'message' => 'El archivo de imagen no es válido o está dañado.',
                ], 400);
            }

            $fileName = 'banner_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('imagenes/portadas');
            if (!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $image->move($destination, $fileName);
            $path = 'imagenes/portadas/' . $fileName;

            $title = trim((string)$request->input('title'));
            if (empty($title)) {
                $title = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            }
            $nextOrder = ((int)BannerImage::max('order')) + 1;

            $banner = BannerImage::create([
                'title' => $title,
                'image_path' => $path,
                'is_active_carousel' => true,
                'is_featured' => false,
                'order' => $nextOrder,
            ]);

            AuditLog::record('create', 'BannerImage', $banner->id, "Foto de portada subida: {$banner->title} ({$path})");

            return response()->json([
                'success' => true,
                'banner' => $banner,
                'url' => asset($path),
                'message' => '¡Foto de portada subida y agregada al catálogo exitosamente!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $ve) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación: ' . implode(', ', $ve->validator->errors()->all()),
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al subir la imagen: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Eliminar foto de portada
     */
    public function deleteBannerAjax($id)
    {
        try {
            $banner = BannerImage::findOrFail($id);
            $path = $banner->image_path;

            // No borrar físicamente los 3 archivos base pre-cargados
            if (!in_array($path, ['imagenes/portadas/portada1.png', 'imagenes/portadas/portada2.png', 'imagenes/portadas/portada3.png'])) {
                $fullPath = public_path($path);
                if (File::exists($fullPath)) {
                    File::delete($fullPath);
                }
            }

            $bannerTitle = $banner->title;
            $banner->delete();

            AuditLog::record('delete', 'BannerImage', $id, "Foto de portada eliminada del catálogo: {$bannerTitle}");

            return response()->json([
                'success' => true,
                'message' => 'Foto eliminada del catálogo exitosamente.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la foto: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Alternar inclusión en el carrusel animado
     */
    public function toggleBannerCarousel($id)
    {
        try {
            $banner = BannerImage::findOrFail($id);
            $banner->is_active_carousel = !$banner->is_active_carousel;
            $banner->save();

            AuditLog::record('update', 'BannerImage', $banner->id, "Inclusión en carrusel modificada para '{$banner->title}': " . ($banner->is_active_carousel ? 'Activa' : 'Desactivada'));

            return response()->json([
                'success' => true,
                'is_active_carousel' => $banner->is_active_carousel,
                'message' => $banner->is_active_carousel ? 'Foto incluida en la rotación del carrusel.' : 'Foto excluida de la rotación del carrusel.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el carrusel: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fijar como fotografía estática de portada
     */
    public function selectBannerFeatured($id)
    {
        try {
            $banner = BannerImage::findOrFail($id);

            // Desmarcar otros destacados
            BannerImage::query()->update(['is_featured' => false]);
            $banner->is_featured = true;
            $banner->save();

            // Guardar configuración
            SiteSetting::updateOrCreate(
                ['key' => 'hero_image_path'],
                ['value' => $banner->image_path, 'group' => 'hero', 'type' => 'text']
            );

            AuditLog::record('update', 'BannerImage', $banner->id, "Foto fijada como portada institucional principal: {$banner->title}");

            return response()->json([
                'success' => true,
                'path' => $banner->image_path,
                'message' => "¡La foto \"{$banner->title}\" ha sido establecida como portada fija!",
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al fijar la foto: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Reordenar secuencia de fotos en el carrusel
     */
    public function reorderBanner(Request $request, $id)
    {
        try {
            $banner = BannerImage::findOrFail($id);
            $direction = $request->input('direction');

            // Asegurar que todos los banners tengan orden normalizado 1, 2, 3...
            $banners = BannerImage::orderBy('order')->orderBy('id', 'asc')->get();
            foreach ($banners as $idx => $b) {
                if ($b->order != ($idx + 1)) {
                    $b->order = $idx + 1;
                    $b->saveQuietly();
                }
            }

            $banner->refresh();
            $currentOrder = (int)$banner->order;

            if ($direction === 'up' && $currentOrder > 1) {
                // Intercambiar con el anterior (mover a la izquierda)
                $targetOrder = $currentOrder - 1;
                $prevBanner = BannerImage::where('order', $targetOrder)->first();
                if ($prevBanner) {
                    $prevBanner->order = $currentOrder;
                    $prevBanner->save();
                }
                $banner->order = $targetOrder;
                $banner->save();
            } elseif ($direction === 'down') {
                // Intercambiar con el siguiente (mover a la derecha)
                $maxOrder = BannerImage::max('order');
                if ($currentOrder < $maxOrder) {
                    $targetOrder = $currentOrder + 1;
                    $nextBanner = BannerImage::where('order', $targetOrder)->first();
                    if ($nextBanner) {
                        $nextBanner->order = $currentOrder;
                        $nextBanner->save();
                    }
                    $banner->order = $targetOrder;
                    $banner->save();
                }
            } elseif ($request->filled('new_order')) {
                $newOrder = max(1, (int)$request->input('new_order'));
                $banner->order = $newOrder;
                $banner->save();
            }

            AuditLog::record('update', 'BannerImage', $banner->id, "Orden de foto del carrusel modificado a #{$banner->order}: {$banner->title}");

            $orderedList = BannerImage::orderBy('order')->orderBy('id', 'asc')->get(['id', 'title', 'order', 'is_active_carousel', 'is_featured']);

            return response()->json([
                'success' => true,
                'current_id' => $banner->id,
                'new_order' => $banner->order,
                'banners' => $orderedList,
                'message' => "Posición de '{$banner->title}' actualizada a #{$banner->order}.",
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al reordenar: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360',
            'hero_video_file' => 'nullable|file|mimes:mp4,webm|max:51200',
            'presentation_director_photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        // 1. Manejo de subida de imagen de portada
        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $fileName = 'hero_' . time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('imagenes/portadas');
            if (!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $path = 'imagenes/portadas/' . $fileName;
            SiteSetting::updateOrCreate(
                ['key' => 'hero_image_path'],
                ['value' => $path, 'group' => 'hero', 'type' => 'text']
            );
            BannerImage::query()->update(['is_featured' => false]);
            BannerImage::create([
                'title' => 'Foto Subida ' . date('d/m/Y H:i'),
                'image_path' => $path,
                'is_active_carousel' => true,
                'is_featured' => true,
                'order' => ((int)BannerImage::max('order')) + 1,
            ]);
        } elseif ($request->filled('hero_image_preset')) {
            SiteSetting::updateOrCreate(
                ['key' => 'hero_image_path'],
                ['value' => $request->hero_image_preset, 'group' => 'hero', 'type' => 'text']
            );
            BannerImage::query()->update(['is_featured' => false]);
            BannerImage::where('image_path', $request->hero_image_preset)->update(['is_featured' => true]);
        }

        // 2. Manejo de subida o asignación directa de video de portada
        if ($request->hasFile('hero_video_file')) {
            $video = $request->file('hero_video_file');
            if ($video->isValid()) {
                $videoName = 'hero_video_' . time() . '.' . $video->getClientOriginalExtension();
                $destination = public_path('videos');
                if (!File::isDirectory($destination)) {
                    File::makeDirectory($destination, 0755, true);
                }
                $video->move($destination, $videoName);
                SiteSetting::updateOrCreate(
                    ['key' => 'hero_video_path'],
                    ['value' => 'videos/' . $videoName, 'group' => 'hero', 'type' => 'text']
                );
            }
        } elseif ($request->filled('hero_video_path_manual')) {
            SiteSetting::updateOrCreate(
                ['key' => 'hero_video_path'],
                ['value' => trim($request->hero_video_path_manual), 'group' => 'hero', 'type' => 'text']
            );
        }

        // 3. Manejo de subida o eliminación de fotografía del Director / Oficina
        if ($request->has('remove_presentation_director_photo')) {
            $oldDirectorPhoto = SiteSetting::get('presentation_director_photo');
            if ($oldDirectorPhoto && File::exists(public_path($oldDirectorPhoto))) {
                File::delete(public_path($oldDirectorPhoto));
            }
            SiteSetting::updateOrCreate(
                ['key' => 'presentation_director_photo'],
                ['value' => null, 'group' => 'presentation']
            );
        } elseif ($request->hasFile('presentation_director_photo_file')) {
            $photo = $request->file('presentation_director_photo_file');
            $photoName = 'director_' . time() . '.' . $photo->getClientOriginalExtension();
            $destination = public_path('imagenes/direccion');
            if (!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $photo->move($destination, $photoName);
            SiteSetting::updateOrCreate(
                ['key' => 'presentation_director_photo'],
                ['value' => 'imagenes/direccion/' . $photoName, 'group' => 'presentation']
            );
        }

        $data = $request->except([
            '_token',
            '_method',
            'hero_image_file',
            'hero_video_file',
            'hero_image_preset',
            'hero_video_path_manual',
            'presentation_director_photo_file',
            'remove_presentation_director_photo',
        ]);

        foreach ($data as $key => $val) {
            $group = 'general';
            if (str_starts_with($key, 'hero_')) {
                $group = 'hero';
            } elseif (str_starts_with($key, 'presentation_')) {
                $group = 'presentation';
            } elseif (str_starts_with($key, 'mv_')) {
                $group = 'mission_vision';
            } elseif (str_starts_with($key, 'resources_')) {
                $group = 'resources';
            } elseif (str_starts_with($key, 'team_')) {
                $group = 'team';
            } elseif (str_starts_with($key, 'contact_')) {
                $group = 'contact';
            } elseif (str_starts_with($key, 'stat_')) {
                $group = 'stats';
            }

            // Guardado inteligente con preservación y auto-traducción
            if (str_ends_with($key, '_en')) {
                $baseKey = substr($key, 0, -3);
                if (!empty(trim((string)$val))) {
                    SiteSetting::where('key', $baseKey)->update(['value_en' => $val]);
                }
            } else {
                $setting = SiteSetting::firstOrNew(['key' => $key]);
                $setting->value = $val;
                $setting->group = $group;
                // Si no se proporcionó traducción en inglés manual, dejar que el observer auto-traduzca
                if ($request->filled($key . '_en')) {
                    $setting->value_en = $request->input($key . '_en');
                } elseif (empty($setting->value_en) || $setting->isDirty('value')) {
                    $setting->value_en = null; // para que se vuelva a auto-traducir con el nuevo valor
                }
                $setting->save();
            }
        }

        AuditLog::record('update', 'SiteSetting', null, 'Ajustes institucionales, textos y multimedia actualizados desde Intranet.');

        return redirect()->route('admin.settings.index')->with('success', 'Contenidos institucionales, fotografías y multimedia actualizados exitosamente.');
    }
}

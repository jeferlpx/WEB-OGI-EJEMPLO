@extends('layouts.admin')

@section('title', 'Editar Aliado Estratégico')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Editar Aliado Estratégico</h1>
            <p class="text-xs text-[var(--text-muted)]">Actualiza los datos o sustituye el logotipo del aliado.</p>
        </div>
        <a href="{{ route('admin.partners.index') }}" class="text-xs font-semibold text-[var(--text-muted)] hover:text-[var(--text-primary)]">
            ← Volver al listado
        </a>
    </div>

    <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data" class="card-molinero p-6 space-y-5">
        @csrf
        @method('PUT')

        <!-- Barra Bilingüe con Auto-traducción con IA -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3 bg-emerald-50/70 dark:bg-emerald-950/40 rounded-xl border border-emerald-200 dark:border-emerald-800">
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 text-[10px] font-black uppercase tracking-wider rounded-md bg-[#0F5132] text-white">Bilingüe</span>
                <span class="text-xs text-[var(--text-secondary)]">Si actualiza la descripción en español y deja el campo en inglés vacío, se auto-traduce al guardar.</span>
            </div>
            <button type="button" onclick="autoTranslateForm(this)" class="btn-molinero text-xs flex items-center justify-center gap-1.5 py-1.5 px-3 shadow-sm whitespace-nowrap">
                <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>✨ Auto-traducir a Inglés</span>
            </button>
        </div>

        <div class="space-y-1">
            <label class="block text-xs font-bold text-[var(--text-primary)]">Nombre del Aliado / Organismo *</label>
            <input type="text" name="name" value="{{ old('name', $partner->name) }}" required class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" />
            @error('name') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Categoría *</label>
                <select name="category" required class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500">
                    <option value="agencia_cooperacion" {{ old('category', $partner->category) === 'agencia_cooperacion' ? 'selected' : '' }}>Agencia de Cooperación</option>
                    <option value="red_internacional" {{ old('category', $partner->category) === 'red_internacional' ? 'selected' : '' }}>Red Internacional / Embajada</option>
                    <option value="red_nacional" {{ old('category', $partner->category) === 'red_nacional' ? 'selected' : '' }}>Red Nacional / Entidad Pública</option>
                    <option value="consorcio" {{ old('category', $partner->category) === 'consorcio' ? 'selected' : '' }}>Consorcio Universitario</option>
                </select>
                @error('category') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Sitio Web Oficial (URL)</label>
                <input type="url" name="website_url" value="{{ old('website_url', $partner->website_url) }}" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" />
                @error('website_url') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-xs font-bold text-[var(--text-primary)]">Logotipo Oficial del Aliado</label>
            <div class="flex flex-col sm:flex-row sm:items-center gap-4 p-3 bg-gray-50 dark:bg-emerald-950/20 rounded-lg border border-[var(--border-color)]">
                @if($partner->logo_path)
                <div class="w-32 h-16 bg-white dark:bg-[#121F19] rounded-lg border border-gray-200 dark:border-emerald-900/50 flex items-center justify-center p-2 shadow-sm">
                    <img src="{{ asset($partner->logo_path) }}" alt="{{ $partner->name }}" class="max-h-full max-w-full object-contain" />
                </div>
                <div class="flex-1 text-xs text-[var(--text-muted)] space-y-2">
                    <div>
                        <span class="font-mono text-[11px] block truncate max-w-xs text-[var(--text-primary)] font-semibold">{{ $partner->logo_path }}</span>
                        <span class="text-[11px]">Logotipo activo visible en carruseles y convenios.</span>
                    </div>
                    <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-rose-600 dark:text-rose-400 hover:text-rose-700 bg-rose-50 dark:bg-rose-950/40 px-2.5 py-1 rounded-md border border-rose-200 dark:border-rose-900/50">
                        <input type="checkbox" name="remove_logo" value="1" class="rounded border-rose-300 text-rose-600 focus:ring-rose-500">
                        <span>🗑️ Quitar logotipo actual</span>
                    </label>
                </div>
                @else
                <img src="{{ asset('imagenes/placeholder_referencia.svg') }}" alt="Sin logotipo" class="w-28 h-16 object-cover rounded-lg border border-amber-300 dark:border-amber-700/60 shadow-sm" />
                <div class="flex-1 text-xs text-amber-700 dark:text-amber-400">
                    <span class="font-bold block">Logotipo Pendiente de Carga</span>
                    <span class="text-[11px] text-[var(--text-muted)] block">Actualmente no cuenta con imagen de logo. Se mostrará el nombre del aliado o insignia institucional.</span>
                </div>
                @endif
            </div>
            <div class="space-y-1">
                <label class="block text-[11px] font-semibold text-[var(--text-secondary)]">Subir nuevo logotipo (o reemplazar el actual):</label>
                <input type="file" name="logo" accept="image/*" class="w-full text-xs p-2 border border-[var(--border-color)] rounded-lg bg-[var(--bg-surface)] text-[var(--text-primary)] file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:bg-emerald-50 dark:file:bg-emerald-950 file:text-emerald-700 dark:file:text-emerald-300" />
            </div>
            @error('logo') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="space-y-1">
            <label class="block text-xs font-bold text-[var(--text-primary)]">Descripción (Español)</label>
            <textarea name="description" rows="2" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500">{{ old('description', $partner->description) }}</textarea>
        </div>

        <div class="space-y-1">
            <label class="block text-xs font-bold text-[var(--text-primary)]">Descripción en Inglés (Description in English)</label>
            <textarea name="description_en" rows="2" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="Auto-traducible si se deja vacío...">{{ old('description_en', $partner->description_en) }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Orden de Aparición</label>
                <input type="number" name="order" value="{{ old('order', $partner->order) }}" min="1" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)]" />
            </div>

            <div class="flex items-center gap-2 pt-6">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $partner->is_active) ? 'checked' : '' }} class="rounded border-[var(--border-color)] text-[#0F5132] focus:ring-emerald-500 w-4 h-4" />
                <label for="is_active" class="text-xs font-semibold text-[var(--text-primary)]">Mostrar activamente en el portal web</label>
            </div>
        </div>

        <div class="pt-4 border-t border-[var(--border-color)] flex items-center justify-between">
            <button type="button" onclick="autoTranslateForm(this)" class="btn-molinero-outline text-xs flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>Auto-traducir a Inglés</span>
            </button>
            <div class="flex gap-3">
                <a href="{{ route('admin.partners.index') }}" class="px-4 py-2 text-xs font-medium rounded-lg border border-[var(--border-color)] text-[var(--text-secondary)] hover:bg-gray-100 dark:hover:bg-gray-800">Cancelar</a>
                <button type="submit" class="btn-molinero text-xs py-2 px-5">Guardar Cambios</button>
            </div>
        </div>
        </div>
    </form>
</div>
@endsection

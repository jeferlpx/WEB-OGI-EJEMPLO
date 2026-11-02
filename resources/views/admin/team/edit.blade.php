@extends('layouts.admin')

@section('title', 'Editar Miembro del Equipo')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Editar Miembro del Equipo</h1>
            <p class="text-xs text-[var(--text-muted)]">Actualiza los datos profesionales o actualiza la foto oficial.</p>
        </div>
        <a href="{{ route('admin.team.index') }}" class="text-xs font-semibold text-[var(--text-muted)] hover:text-[var(--text-primary)]">
            ← Volver al listado
        </a>
    </div>

    <form action="{{ route('admin.team.update', $member->id) }}" method="POST" enctype="multipart/form-data" class="card-molinero p-6 space-y-5">
        @csrf
        @method('PUT')

        <!-- Barra Bilingüe con Auto-traducción con IA -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3 bg-emerald-50/70 dark:bg-emerald-950/40 rounded-xl border border-emerald-200 dark:border-emerald-800">
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 text-[10px] font-black uppercase tracking-wider rounded-md bg-[#0F5132] text-white">Bilingüe</span>
                <span class="text-xs text-[var(--text-secondary)]">Si actualiza los textos en español y deja los campos en inglés vacíos, se traducirán al guardar.</span>
            </div>
            <button type="button" onclick="autoTranslateForm(this)" class="btn-molinero text-xs flex items-center justify-center gap-1.5 py-1.5 px-3 shadow-sm whitespace-nowrap">
                <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>✨ Auto-traducir a Inglés</span>
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Nombres y Apellidos *</label>
                <input type="text" name="name" value="{{ old('name', $member->name) }}" required class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" />
                @error('name') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Cargo / Título Profesional (Español) *</label>
                <input type="text" name="role_title" value="{{ old('role_title', $member->role_title) }}" required class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" />
                @error('role_title') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1 sm:col-span-2">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Cargo en Inglés (Role Title in English)</label>
                <input type="text" name="role_title_en" value="{{ old('role_title_en', $member->role_title_en) }}" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="Auto-traducible si se deja vacío..." />
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Área / Coordinación</label>
                <input type="text" name="department" value="{{ old('department', $member->department) }}" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" />
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Correo Institucional</label>
                <input type="email" name="email" value="{{ old('email', $member->email) }}" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" />
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Teléfono / Anexo</label>
                <input type="text" name="phone" value="{{ old('phone', $member->phone) }}" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" />
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-xs font-bold text-[var(--text-primary)]">Fotografía Oficial del Miembro</label>
            <div class="flex flex-col sm:flex-row sm:items-center gap-4 p-3 bg-gray-50 dark:bg-emerald-950/20 rounded-lg border border-[var(--border-color)]">
                @if($member->photo_path)
                <img src="{{ asset($member->photo_path) }}" alt="{{ $member->name }}" class="w-16 h-20 object-cover rounded-lg border border-gray-200 dark:border-emerald-900/50 shadow-sm" />
                <div class="flex-1 text-xs text-[var(--text-muted)] space-y-2">
                    <div>
                        <span class="font-mono text-[11px] block truncate max-w-xs text-[var(--text-primary)] font-semibold">{{ $member->photo_path }}</span>
                        <span class="text-[11px]">Fotografía oficial activa en el portal.</span>
                    </div>
                    <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-rose-600 dark:text-rose-400 hover:text-rose-700 bg-rose-50 dark:bg-rose-950/40 px-2.5 py-1 rounded-md border border-rose-200 dark:border-rose-900/50">
                        <input type="checkbox" name="remove_photo" value="1" class="rounded border-rose-300 text-rose-600 focus:ring-rose-500">
                        <span>🗑️ Quitar fotografía actual y usar silueta institucional de referencia</span>
                    </label>
                </div>
                @else
                <img src="{{ asset('imagenes/placeholder_referencia.svg') }}" alt="Sin fotografía" class="w-20 h-20 object-cover rounded-lg border border-amber-300 dark:border-amber-700/60 shadow-sm" />
                <div class="flex-1 text-xs text-amber-700 dark:text-amber-400">
                    <span class="font-bold block">Fotografía Pendiente de Carga</span>
                    <span class="text-[11px] text-[var(--text-muted)] block">Actualmente este miembro no cuenta con fotografía. En el portal público se muestra la imagen institucional de referencia o silueta oficial UNALM.</span>
                </div>
                @endif
            </div>
            <div class="space-y-1">
                <label class="block text-[11px] font-semibold text-[var(--text-secondary)]">Subir nueva fotografía (o reemplazar la existente):</label>
                <input type="file" name="photo" accept="image/*" class="w-full text-xs p-2 border border-[var(--border-color)] rounded-lg bg-[var(--bg-surface)] text-[var(--text-primary)] file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:bg-emerald-50 dark:file:bg-emerald-950 file:text-emerald-700 dark:file:text-emerald-300" />
            </div>
            @error('photo') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="space-y-1">
            <label class="block text-xs font-bold text-[var(--text-primary)]">Perfil Profesional / Reseña Biográfica (Español)</label>
            <textarea name="bio" rows="3" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500">{{ old('bio', $member->bio) }}</textarea>
        </div>

        <div class="space-y-1">
            <label class="block text-xs font-bold text-[var(--text-primary)]">Biografía en Inglés (Biography in English)</label>
            <textarea name="bio_en" rows="3" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="Auto-traducible si se deja vacío...">{{ old('bio_en', $member->bio_en) }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Orden de Aparición</label>
                <input type="number" name="order" value="{{ old('order', $member->order) }}" min="1" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)]" />
            </div>

            <div class="flex items-center gap-2 pt-6">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $member->is_active) ? 'checked' : '' }} class="rounded border-[var(--border-color)] text-[#0F5132] focus:ring-emerald-500 w-4 h-4" />
                <label for="is_active" class="text-xs font-semibold text-[var(--text-primary)]">Mostrar activamente en el Directorio Institucional</label>
            </div>
        </div>

        <div class="pt-4 border-t border-[var(--border-color)] flex items-center justify-between">
            <button type="button" onclick="autoTranslateForm(this)" class="btn-molinero-outline text-xs flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>Auto-traducir a Inglés</span>
            </button>
            <div class="flex gap-3">
                <a href="{{ route('admin.team.index') }}" class="px-4 py-2 text-xs font-medium rounded-lg border border-[var(--border-color)] text-[var(--text-secondary)] hover:bg-gray-100 dark:hover:bg-gray-800">Cancelar</a>
                <button type="submit" class="btn-molinero text-xs py-2 px-5">Guardar Cambios</button>
            </div>
        </div>
    </form>
</div>
@endsection

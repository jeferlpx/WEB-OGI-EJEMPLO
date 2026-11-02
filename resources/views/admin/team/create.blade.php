@extends('layouts.admin')

@section('title', 'Nuevo Miembro del Equipo')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Nuevo Miembro del Equipo OGI</h1>
            <p class="text-xs text-[var(--text-muted)]">Registra un nuevo funcionario, coordinador o directivo con su fotografía oficial.</p>
        </div>
        <a href="{{ route('admin.team.index') }}" class="text-xs font-semibold text-[var(--text-muted)] hover:text-[var(--text-primary)]">
            ← Volver al listado
        </a>
    </div>

    <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="card-molinero p-6 space-y-5">
        @csrf

        <!-- Barra Bilingüe con Auto-traducción con IA -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3 bg-emerald-50/70 dark:bg-emerald-950/40 rounded-xl border border-emerald-200 dark:border-emerald-800">
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 text-[10px] font-black uppercase tracking-wider rounded-md bg-[#0F5132] text-white">Bilingüe</span>
                <span class="text-xs text-[var(--text-secondary)]">El cargo y biografía se traducen al guardar si se dejan vacíos.</span>
            </div>
            <button type="button" onclick="autoTranslateForm(this)" class="btn-molinero text-xs flex items-center justify-center gap-1.5 py-1.5 px-3 shadow-sm whitespace-nowrap">
                <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>✨ Auto-traducir a Inglés</span>
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Nombres y Apellidos *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="Ej: Dr. Christian René Encina Zelada" />
                @error('name') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Cargo / Título Profesional (Español) *</label>
                <input type="text" name="role_title" value="{{ old('role_title') }}" required class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="Ej: Director de la OGI" />
                @error('role_title') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1 sm:col-span-2">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Cargo en Inglés (Role Title in English)</label>
                <input type="text" name="role_title_en" value="{{ old('role_title_en') }}" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="Opcional: Se auto-traduce automáticamente si se deja vacío..." />
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Área / Coordinación</label>
                <input type="text" name="department" value="{{ old('department') }}" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="Ej: Dirección / Movilidad" />
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Correo Institucional</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="usuario@lamolina.edu.pe" />
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Teléfono / Anexo</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="(01) 614-7800 Anx. 212" />
            </div>
        </div>

        <div class="space-y-1">
            <label class="block text-xs font-bold text-[var(--text-primary)]">Fotografía Oficial del Miembro (Recuadro Retrato)</label>
            <input type="file" name="photo" accept="image/*" class="w-full text-xs p-2 border border-[var(--border-color)] rounded-lg bg-[var(--bg-surface)] text-[var(--text-primary)] file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:bg-emerald-50 dark:file:bg-emerald-950 file:text-emerald-700 dark:file:text-emerald-300" />
            <p class="text-[11px] text-[var(--text-muted)]">Recomendado: fotografía formal vertical de buena iluminación, proporción 3:4 o 1:1.</p>
            @error('photo') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="space-y-1">
            <label class="block text-xs font-bold text-[var(--text-primary)]">Perfil Profesional / Reseña Biográfica (Español)</label>
            <textarea name="bio" rows="3" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="Breve reseña sobre experiencia académica, formación o responsabilidades en la oficina...">{{ old('bio') }}</textarea>
        </div>

        <div class="space-y-1">
            <label class="block text-xs font-bold text-[var(--text-primary)]">Biografía en Inglés (Biography in English)</label>
            <textarea name="bio_en" rows="3" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="Opcional: Se auto-traduce automáticamente si se deja vacío...">{{ old('bio_en') }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Orden de Aparición</label>
                <input type="number" name="order" value="{{ old('order', 1) }}" min="1" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)]" />
            </div>

            <div class="flex items-center gap-2 pt-6">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }} class="rounded border-[var(--border-color)] text-[#0F5132] focus:ring-emerald-500 w-4 h-4" />
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
                <button type="submit" class="btn-molinero text-xs py-2 px-5">Guardar Miembro</button>
            </div>
        </div>
    </form>
</div>
@endsection

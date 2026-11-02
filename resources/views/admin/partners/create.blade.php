@extends('layouts.admin')

@section('title', 'Nuevo Aliado Estratégico')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Nuevo Aliado Estratégico</h1>
            <p class="text-xs text-[var(--text-muted)]">Registra un nuevo organismo o consorcio en la plataforma institucional.</p>
        </div>
        <a href="{{ route('admin.partners.index') }}" class="text-xs font-semibold text-[var(--text-muted)] hover:text-[var(--text-primary)]">
            ← Volver al listado
        </a>
    </div>

    <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="card-molinero p-6 space-y-5">
        @csrf

        <!-- Barra Bilingüe con Auto-traducción con IA -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3 bg-emerald-50/70 dark:bg-emerald-950/40 rounded-xl border border-emerald-200 dark:border-emerald-800">
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 text-[10px] font-black uppercase tracking-wider rounded-md bg-[#0F5132] text-white">Bilingüe</span>
                <span class="text-xs text-[var(--text-secondary)]">La descripción se auto-traduce al guardar si se deja vacía.</span>
            </div>
            <button type="button" onclick="autoTranslateForm(this)" class="btn-molinero text-xs flex items-center justify-center gap-1.5 py-1.5 px-3 shadow-sm whitespace-nowrap">
                <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>✨ Auto-traducir a Inglés</span>
            </button>
        </div>

        <div class="space-y-1">
            <label class="block text-xs font-bold text-[var(--text-primary)]">Nombre del Aliado / Organismo *</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="Ej: Comisión Fulbright Perú" />
            @error('name') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Categoría *</label>
                <select name="category" required class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500">
                    <option value="agencia_cooperacion" {{ old('category') === 'agencia_cooperacion' ? 'selected' : '' }}>Agencia de Cooperación</option>
                    <option value="red_internacional" {{ old('category') === 'red_internacional' ? 'selected' : '' }}>Red Internacional / Embajada</option>
                    <option value="red_nacional" {{ old('category') === 'red_nacional' ? 'selected' : '' }}>Red Nacional / Entidad Pública</option>
                    <option value="consorcio" {{ old('category') === 'consorcio' ? 'selected' : '' }}>Consorcio Universitario</option>
                </select>
                @error('category') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Sitio Web Oficial (URL)</label>
                <input type="url" name="website_url" value="{{ old('website_url') }}" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="https://www.fulbright.pe" />
                @error('website_url') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="space-y-1">
            <label class="block text-xs font-bold text-[var(--text-primary)]">Logotipo Oficial (PNG con transparencia o JPG de alta calidad) *</label>
            <input type="file" name="logo" accept="image/*" class="w-full text-xs p-2 border border-[var(--border-color)] rounded-lg bg-[var(--bg-surface)] text-[var(--text-primary)] file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:bg-emerald-50 dark:file:bg-emerald-950 file:text-emerald-700 dark:file:text-emerald-300" />
            <p class="text-[11px] text-[var(--text-muted)]">Recomendado: imagen nítida horizontal, mínimo 400x200 px.</p>
            @error('logo') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="space-y-1">
            <label class="block text-xs font-bold text-[var(--text-primary)]">Descripción Breve (Español)</label>
            <textarea name="description" rows="2" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="Becas e intercambio cultural y académico entre Estados Unidos y el Perú.">{{ old('description') }}</textarea>
        </div>

        <div class="space-y-1">
            <label class="block text-xs font-bold text-[var(--text-primary)]">Descripción en Inglés (Description in English)</label>
            <textarea name="description_en" rows="2" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:ring-2 focus:ring-emerald-500" placeholder="Opcional: Se auto-traduce automáticamente si se deja vacío...">{{ old('description_en') }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
            <div class="space-y-1">
                <label class="block text-xs font-bold text-[var(--text-primary)]">Orden de Aparición</label>
                <input type="number" name="order" value="{{ old('order', 1) }}" min="1" class="w-full text-xs p-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] text-[var(--text-primary)]" />
            </div>

            <div class="flex items-center gap-2 pt-6">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }} class="rounded border-[var(--border-color)] text-[#0F5132] focus:ring-emerald-500 w-4 h-4" />
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
                <button type="submit" class="btn-molinero text-xs py-2 px-5">Guardar Aliado</button>
            </div>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'National Agreements Directory — OGI UNALM' : 'Directorio de Convenios Nacionales — OGI UNALM')

@section('content')
@php
    $typeMap = [
        'convenio marco de cooperación interinstitucional' => 'Framework Agreement for Inter-institutional Cooperation',
        'convenio específico de movilidad académica' => 'Specific Academic Mobility Agreement',
        'acuerdo de cooperación científica y tecnológica' => 'Scientific & Technological Cooperation Agreement',
        'memorándum de entendimiento (mou)' => 'Memorandum of Understanding (MoU)',
        'acuerdo de doble grado / cotutela' => 'Double Degree / Co-tutelle Agreement',
    ];
@endphp

<section class="bg-gradient-to-r from-emerald-950 to-[#0F5132] text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs uppercase font-bold tracking-wider text-emerald-300">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Inter-institutional Linkage in Peru' : 'Vinculación Interinstitucional en el Perú' }}
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-1 mb-3">
            {{ ($currentLocale ?? 'es') === 'en' ? 'National Agreements' : 'Convenios Nacionales' }}
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed max-w-3xl">
            {{ ($currentLocale ?? 'es') === 'en'
                ? 'Strategic alliances with public and private universities, regional governments, municipalities, ministries, and Peruvian enterprises for academic, scientific, and productive development.'
                : 'Alianzas estratégicas con universidades públicas y privadas, gobiernos regionales, municipalidades, ministerios y empresas peruanas para el desarrollo académico, científico y productivo.' }}
        </p>
    </div>
</section>

<section class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-[var(--bg-surface)] p-6 rounded-xl border border-[var(--border-color)] shadow-sm mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="agreement-search-input" class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Search National Institution or Keyword' : 'Buscar Institución Nacional o Palabra Clave' }}
                </label>
                <div class="relative">
                    <input type="text" id="agreement-search-input" placeholder="{{ ($currentLocale ?? 'es') === 'en' ? 'e.g. Callao, UTEC, Quillabamba, ESAN...' : 'Ej. Callao, UTEC, Quillabamba, ESAN...' }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
                    <svg class="w-4 h-4 text-gray-400 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <div>
                <label for="agreement-type-select" class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Agreement Type' : 'Tipo de Acuerdo' }}
                </label>
                <select id="agreement-type-select" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="">{{ ($currentLocale ?? 'es') === 'en' ? 'All Agreement Types' : 'Todos los Tipos de Acuerdo' }}</option>
                    @foreach($types as $t)
                    <option value="{{ strtolower($t->name) }}">{{ ($currentLocale ?? 'es') === 'en' ? ($typeMap[strtolower($t->name)] ?? $t->name) : $t->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-[var(--border-color)] flex items-center justify-between text-xs">
            <span class="text-[var(--text-muted)]">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Showing' : 'Mostrando' }} <strong id="agreements-visible-count" class="text-[var(--text-primary)]">{{ $agreements->count() }}</strong> {{ ($currentLocale ?? 'es') === 'en' ? 'indexed national agreements.' : 'convenios nacionales indexados.' }}
            </span>
            <button type="button" id="agreement-reset-filters" class="text-xs font-semibold text-[#0F5132] dark:text-emerald-400 hover:underline">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Reset Filters' : 'Restablecer Filtros' }}
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($agreements as $agr)
        <div class="card-molinero agreement-row flex flex-col justify-between"
             data-search="{{ strtolower($agr->title . ' ' . $agr->institution->name . ' ' . $agr->code) }}"
             data-type="{{ strtolower($agr->type->name) }}">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="inline-flex items-center gap-1 text-xs font-bold text-gray-700 dark:text-gray-300">
                        <span>🇵🇪</span>
                        <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Peru' : 'Perú' }}</span>
                    </span>
                    <span class="badge-status badge-vigente">{{ ($currentLocale ?? 'es') === 'en' ? 'Active' : 'Vigente' }}</span>
                </div>

                <h3 class="text-base font-bold text-[var(--text-primary)] mb-1 leading-snug">
                    {{ $agr->institution->name }}
                </h3>
                <p class="text-[11px] font-medium text-emerald-800 dark:text-emerald-400 mb-3">
                    {{ ($currentLocale ?? 'es') === 'en' ? ($typeMap[strtolower($agr->type->name)] ?? $agr->type->name) : $agr->type->name }}
                </p>

                @php
                    $scopeDisplay = ($currentLocale ?? 'es') === 'en' 
                        ? str_replace(['Toda la UNALM', 'Facultad de '], ['All UNALM', 'Faculty of '], $agr->faculty_scope) 
                        : $agr->faculty_scope;
                @endphp
                <div class="space-y-1.5 text-xs text-[var(--text-secondary)] border-t border-[var(--border-color)] pt-3 mb-4">
                    <div class="flex justify-between">
                        <span class="text-[var(--text-muted)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Code:' : 'Código:' }}</span>
                        <span class="font-mono font-medium">{{ $agr->code ?: 'CN-UNALM' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[var(--text-muted)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Scope:' : 'Alcance:' }}</span>
                        <span class="font-medium truncate max-w-[180px]">{{ $scopeDisplay }}</span>
                    </div>
                </div>
            </div>

            <div class="pt-3 border-t border-[var(--border-color)]">
                @if($agr->file_path)
                <a href="{{ asset($agr->file_path) }}" target="_blank" rel="noopener noreferrer" class="btn-molinero text-xs w-full flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Download Official Document' : 'Descargar Documento Oficial' }}</span>
                </a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

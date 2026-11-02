@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'International Agreements Directory — OGI UNALM' : 'Directorio de Convenios Internacionales — OGI UNALM')

@section('content')
@php
    $typeMap = [
        'convenio marco de cooperación interinstitucional' => 'Framework Agreement for Inter-institutional Cooperation',
        'convenio específico de movilidad académica' => 'Specific Academic Mobility Agreement',
        'acuerdo de cooperación científica y tecnológica' => 'Scientific & Technological Cooperation Agreement',
        'memorándum de entendimiento (mou)' => 'Memorandum of Understanding (MoU)',
        'acuerdo de doble grado / cotutela' => 'Double Degree / Co-tutelle Agreement',
    ];
    $statusMap = [
        'vigente' => 'Active',
        'por_vencer' => 'Expiring Soon',
        'vencido' => 'Expired / In Renewal',
    ];
@endphp

<!-- Cabecera de Sección -->
<section class="bg-gradient-to-r from-emerald-950 to-[#0F5132] text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs uppercase font-bold tracking-wider text-emerald-300">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Global Cooperation Heritage' : 'Patrimonio de Cooperación Global' }}
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-1 mb-3">
                {{ ($currentLocale ?? 'es') === 'en' ? 'International Agreements' : 'Convenios Internacionales' }}
            </h1>
            <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
                {{ ($currentLocale ?? 'es') === 'en'
                    ? 'Official directory of framework and specific agreements signed by Universidad Nacional Agraria La Molina with prestigious universities and institutions across the Americas, Europe, and Asia.'
                    : 'Directorio oficial de acuerdos marco y específicos suscritos por la Universidad Nacional Agraria La Molina con prestigiosas universidades e instituciones de América, Europa y Asia.' }}
            </p>
        </div>
    </div>
</section>

<!-- Buscador y Filtros Interactivos -->
<section class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-[var(--bg-surface)] p-6 rounded-xl border border-[var(--border-color)] shadow-sm mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Input Búsqueda en Vivo -->
            <div class="sm:col-span-2 lg:col-span-1">
                <label for="agreement-search-input" class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Search by Institution or Keyword' : 'Buscar por Institución o Palabra Clave' }}
                </label>
                <div class="relative">
                    <input type="text" id="agreement-search-input" placeholder="{{ ($currentLocale ?? 'es') === 'en' ? 'e.g. Madrid, Leipzig, Tokyo...' : 'Ej. Madrid, Leipzig, Tokyo...' }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
                    <svg class="w-4 h-4 text-gray-400 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Filtro País -->
            <div>
                <label for="agreement-country-select" class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Partner Country' : 'País de Contraparte' }}
                </label>
                <select id="agreement-country-select" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="">{{ ($currentLocale ?? 'es') === 'en' ? 'All Countries' : 'Todos los Países' }} ({{ $countries->count() }})</option>
                    @foreach($countries as $c)
                    <option value="{{ strtolower($c->name) }}">{{ $c->localized_name }} ({{ $c->flag_emoji }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Filtro Tipo de Acuerdo -->
            <div>
                <label for="agreement-type-select" class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Agreement Type' : 'Tipo de Acuerdo' }}
                </label>
                <select id="agreement-type-select" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="">{{ ($currentLocale ?? 'es') === 'en' ? 'All Types' : 'Todos los Tipos' }}</option>
                    @foreach($types as $t)
                    <option value="{{ strtolower($t->name) }}">{{ ($currentLocale ?? 'es') === 'en' ? ($typeMap[strtolower($t->name)] ?? $t->name) : $t->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filtro Estado -->
            <div>
                <label for="agreement-status-select" class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Validity Status' : 'Estado de Vigencia' }}
                </label>
                <select id="agreement-status-select" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="">{{ ($currentLocale ?? 'es') === 'en' ? 'All Statuses' : 'Todos los Estados' }}</option>
                    <option value="vigente">{{ ($currentLocale ?? 'es') === 'en' ? 'Active' : 'Vigente' }}</option>
                    <option value="por_vencer">{{ ($currentLocale ?? 'es') === 'en' ? 'Expiring Soon' : 'Por Vencer' }}</option>
                    <option value="vencido">{{ ($currentLocale ?? 'es') === 'en' ? 'Expired / In Renewal' : 'Vencido / En Renovación' }}</option>
                </select>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-[var(--border-color)] flex flex-wrap items-center justify-between text-xs gap-3">
            <span class="text-[var(--text-muted)]">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Showing' : 'Mostrando' }} <strong id="agreements-visible-count" class="text-[var(--text-primary)]">{{ $agreements->count() }}</strong> {{ ($currentLocale ?? 'es') === 'en' ? 'indexed official agreements.' : 'convenios oficiales indexados.' }}
            </span>
            <button type="button" id="agreement-reset-filters" class="text-xs font-semibold text-[#0F5132] dark:text-emerald-400 hover:underline">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Reset Filters' : 'Restablecer Filtros' }}
            </button>
        </div>
    </div>

    <!-- Lista de Convenios en Rejilla y Tarjetas -->
    <div id="agreements-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($agreements as $agr)
        <div class="card-molinero agreement-row flex flex-col justify-between"
             data-search="{{ strtolower($agr->title . ' ' . $agr->institution->name . ' ' . $agr->institution->country->name . ' ' . $agr->code) }}"
             data-country="{{ strtolower($agr->institution->country->name) }}"
             data-type="{{ strtolower($agr->type->name) }}"
             data-status="{{ strtolower($agr->status) }}">
            <div>
                <!-- Encabezado de la Tarjeta con Bandera y Estado -->
                <div class="flex items-center justify-between mb-3">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-700 dark:text-gray-300">
                        <span class="text-base">{{ $agr->institution->country->flag_emoji }}</span>
                        <span>{{ $agr->institution->country->localized_name }}</span>
                    </span>
                    <span class="badge-status badge-{{ $agr->status }}">
                        {{ ($currentLocale ?? 'es') === 'en' ? ($statusMap[strtolower($agr->status)] ?? ucfirst($agr->status)) : ucfirst(str_replace('_', ' ', $agr->status)) }}
                    </span>
                </div>

                <!-- Institución y Título -->
                <h3 class="text-base font-bold text-[var(--text-primary)] mb-1 leading-snug">
                    {{ $agr->institution->name }}
                </h3>
                <p class="text-[11px] font-medium text-emerald-800 dark:text-emerald-400 mb-3">
                    {{ ($currentLocale ?? 'es') === 'en' ? ($typeMap[strtolower($agr->type->name)] ?? $agr->type->name) : $agr->type->name }}
                </p>

                <!-- Alcance y Fechas -->
                @php
                    $scopeDisplay = ($currentLocale ?? 'es') === 'en' 
                        ? str_replace(['Toda la UNALM', 'Facultad de '], ['All UNALM', 'Faculty of '], $agr->faculty_scope) 
                        : $agr->faculty_scope;
                @endphp
                <div class="space-y-1.5 text-xs text-[var(--text-secondary)] border-t border-[var(--border-color)] pt-3 mb-4">
                    <div class="flex justify-between">
                        <span class="text-[var(--text-muted)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Code:' : 'Código:' }}</span>
                        <span class="font-mono font-medium">{{ $agr->code ?: 'S/C' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[var(--text-muted)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Scope:' : 'Alcance:' }}</span>
                        <span class="font-medium truncate max-w-[180px]">{{ $scopeDisplay }}</span>
                    </div>
                    @if($agr->expires_at)
                    <div class="flex justify-between">
                        <span class="text-[var(--text-muted)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Valid until:' : 'Vigencia hasta:' }}</span>
                        <span class="font-medium">{{ $agr->expires_at->format(($currentLocale ?? 'es') === 'en' ? 'M d, Y' : 'd/m/Y') }}</span>
                    </div>
                    @else
                    <div class="flex justify-between">
                        <span class="text-[var(--text-muted)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Validity:' : 'Vigencia:' }}</span>
                        <span class="font-medium text-emerald-700 dark:text-emerald-400">{{ ($currentLocale ?? 'es') === 'en' ? 'Indefinite' : 'Indefinido' }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Botón de Descarga de Documento Oficial -->
            <div class="pt-3 border-t border-[var(--border-color)]">
                @if($agr->file_path)
                <a href="{{ asset($agr->file_path) }}" target="_blank" rel="noopener noreferrer" class="btn-molinero text-xs w-full flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Download Document (PDF)' : 'Descargar Documento (PDF)' }}</span>
                </a>
                @else
                <span class="text-[11px] text-[var(--text-muted)] italic text-center block py-1.5">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Document on file at General Secretariat' : 'Documento custodiado en Secretaría General' }}
                </span>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <!-- Mensaje de Sin Resultados -->
    <div id="agreements-empty-state" class="text-center py-16 hidden">
        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <h4 class="text-base font-bold text-[var(--text-primary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'No agreements found matching the selected criteria' : 'No se encontraron convenios con los criterios seleccionados' }}</h4>
        <p class="text-xs text-[var(--text-muted)] mt-1">{{ ($currentLocale ?? 'es') === 'en' ? 'Try adjusting the filters or using broader search terms.' : 'Pruebe ajustando los filtros o utilizando términos más generales.' }}</p>
    </div>
</section>
@endsection

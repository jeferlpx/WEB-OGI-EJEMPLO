@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'Resources & Official Documents — OGI UNALM' : 'Recursos y Documentos Oficiales — OGI UNALM')

@section('content')
@php
    $resCatMap = [
        'guia' => 'Handbook / Guide',
        'resolucion' => 'Official Resolution',
        'formato' => 'Application Form',
        'boletin' => 'Newsletter',
        'reglamento' => 'Regulations',
    ];
    $audMap = [
        'estudiantes' => 'Students',
        'docentes' => 'Faculty',
        'investigadores' => 'Researchers',
        'comunidad_molinera' => 'Entire UNALM Community',
    ];
@endphp

<!-- Cabecera Institucional Dinámica -->
<section class="bg-gradient-to-r from-emerald-950 via-[#0F5132] to-[#0A3622] text-white py-14 border-b border-emerald-900/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs uppercase font-bold tracking-wider text-emerald-300">
            {{ \App\Models\SiteSetting::get('resources_badge', 'Repositorio Documental', $currentLocale ?? 'es') }}
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white mt-1 mb-3">
            {{ \App\Models\SiteSetting::get('resources_title', 'Recursos, Guías y Reglamentos', $currentLocale ?? 'es') }}
        </h1>
        <p class="text-xs sm:text-base text-emerald-100/95 leading-relaxed max-w-3xl">
            {{ \App\Models\SiteSetting::get('resources_subtitle', 'Descarga directa de instructivos de intercambio, normativas institucionales, boletines molineros y consolidados oficiales de convenios.', $currentLocale ?? 'es') }}
        </p>
    </div>
</section>

<!-- Listado de Recursos con Iconos de Alto Contraste en Modo Claro y Oscuro -->
<section class="py-16 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="space-y-4">
        @forelse($resources as $res)
        <div class="card-molinero p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-5 group hover:border-emerald-500/60 transition-all">
            <div class="flex items-start gap-4">
                <!-- Icono de Documento Nítido y de Alto Contraste -->
                @php
                    $ext = strtolower($res->file_ext);
                    $badgeBg = 'from-red-600 to-red-700 border-red-500/40';
                    if (in_array($ext, ['doc', 'docx'])) {
                        $badgeBg = 'from-blue-600 to-blue-700 border-blue-500/40';
                    } elseif (in_array($ext, ['xls', 'xlsx'])) {
                        $badgeBg = 'from-emerald-700 to-emerald-800 border-emerald-500/40';
                    }
                @endphp
                <div class="w-12 h-14 rounded-xl bg-gradient-to-b {{ $badgeBg }} text-white flex flex-col items-center justify-center flex-shrink-0 shadow-md border mt-0.5 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5 text-white drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span class="text-[9px] font-black tracking-wider uppercase text-white mt-0.5">{{ strtoupper($res->file_ext ?: 'PDF') }}</span>
                </div>

                <div>
                    <h3 class="text-sm sm:text-base font-bold text-[var(--text-primary)] mb-1 group-hover:text-[#0F5132] dark:group-hover:text-emerald-400 transition-colors">
                        {{ $res->trans('title') }}
                    </h3>
                    @if($res->description)
                    <p class="text-xs text-[var(--text-muted)] line-clamp-2 mb-2 leading-relaxed">
                        {{ $res->trans('description') }}
                    </p>
                    @endif
                    <div class="flex flex-wrap items-center gap-2 sm:gap-3 text-[11px] text-[var(--text-muted)]">
                        <span class="uppercase font-bold text-[#0F5132] dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 px-2 py-0.5 rounded-full border border-emerald-200 dark:border-emerald-800/60">
                            {{ ($currentLocale ?? 'es') === 'en' ? ($resCatMap[strtolower($res->category)] ?? ucfirst($res->category)) : ucfirst($res->category) }}
                        </span>
                        <span>•</span>
                        <span>{{ $res->file_size_kb }} KB</span>
                        <span>•</span>
                        <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Audience:' : 'Público:' }} <strong class="text-[var(--text-primary)]">{{ ($currentLocale ?? 'es') === 'en' ? ($audMap[strtolower($res->target_audience)] ?? ucfirst(str_replace('_', ' ', $res->target_audience))) : ucfirst(str_replace('_', ' ', $res->target_audience)) }}</strong></span>
                    </div>
                </div>
            </div>

            <div class="flex-shrink-0 pt-2 sm:pt-0">
                <a href="{{ asset($res->file_path) }}" target="_blank" rel="noopener noreferrer" class="btn-molinero text-xs py-2.5 px-4 flex items-center justify-center gap-2 whitespace-nowrap shadow-sm hover:shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Download File' : 'Descargar Archivo' }}</span>
                </a>
            </div>
        </div>
        @empty
        <div class="card-molinero p-12 text-center text-xs text-[var(--text-muted)]">
            {{ ($currentLocale ?? 'es') === 'en' ? 'No resources or regulations available in this category.' : 'No hay recursos ni reglamentos disponibles en esta categoría.' }}
        </div>
        @endforelse
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', $page->getTranslated('title') . ' — OGI UNALM')

@section('content')
<!-- Cabecera Institucional con Breadcrumb -->
<section class="bg-gradient-to-b from-emerald-950 via-[#0F5132] to-[#0A3622] text-white py-12 sm:py-16 relative overflow-hidden">
    @if($page->banner_image_path)
        <img src="{{ asset($page->banner_image_path) }}" alt="{{ $page->getTranslated('title') }}" class="absolute inset-0 w-full h-full object-cover opacity-20 z-0">
    @else
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>
    @endif

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <!-- Breadcrumbs -->
        <nav class="flex items-center justify-center gap-2 text-xs text-emerald-200/90 mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ ($currentLocale ?? 'es') === 'en' ? 'Home' : 'Inicio' }}</a>
            <span class="text-emerald-400">/</span>
            <span class="text-emerald-300 font-semibold">{{ $page->section_label }}</span>
            <span class="text-emerald-400">/</span>
            <span class="text-white font-bold truncate max-w-xs">{{ $page->getTranslated('title') }}</span>
        </nav>

        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-200 text-xs font-semibold mb-4 backdrop-blur-sm">
            <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
            <span>{{ $page->section_label }}</span>
        </span>

        <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight uppercase max-w-4xl mx-auto">
            {{ $page->getTranslated('title') }}
        </h1>

        @if($page->getTranslated('summary'))
            <p class="mt-4 text-sm sm:text-base text-emerald-100/90 max-w-3xl mx-auto leading-relaxed">
                {{ $page->getTranslated('summary') }}
            </p>
        @endif
    </div>
</section>

<!-- Cuerpo Principal de la Página Institucional -->
<section class="py-12 sm:py-16 bg-[var(--bg-page)] min-h-[500px]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-[var(--bg-surface)] rounded-2xl border border-[var(--border-color)] shadow-xl p-6 sm:p-10 space-y-8">
            
            <!-- Encabezado con Divisor Institucional Molinero (como en las páginas oficiales ORI) -->
            <div class="text-center space-y-3">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0F5132] dark:text-emerald-400 uppercase tracking-wide">
                    {{ $page->getTranslated('title') }}
                </h2>
                
                <!-- Divisor con punto central Molinero -->
                <div class="flex items-center justify-center gap-3 py-1">
                    <span class="w-16 sm:w-24 h-0.5 bg-emerald-600/40"></span>
                    <span class="w-3 h-3 rounded-full bg-[#0F5132] dark:bg-emerald-500 shadow-sm"></span>
                    <span class="w-16 sm:w-24 h-0.5 bg-emerald-600/40"></span>
                </div>
            </div>

            <!-- Contenido Principal -->
            <div class="prose prose-emerald dark:prose-invert max-w-none text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed space-y-4 font-sans text-justify sm:text-left">
                {!! $page->getTranslated('content') !!}
            </div>

            <!-- Fotografía Oficial Destacada o Imagen de Referencia -->
            @php
                $hasRealPhoto = ($page->featured_image_path && file_exists(public_path($page->featured_image_path)));
                $featuredImg = $hasRealPhoto 
                    ? $page->featured_image_path 
                    : ('imagenes/placeholder_referencia' . (($currentLocale ?? 'es') === 'en' ? '_en' : '') . '.svg');
            @endphp
            <div class="pt-4 flex flex-col items-center justify-center">
                <div class="p-2 bg-white dark:bg-black rounded-xl border-2 border-black/80 dark:border-emerald-700/80 shadow-2xl max-w-2xl overflow-hidden group">
                    <img src="{{ asset($featuredImg) }}" alt="{{ $page->getTranslated('title') }}" class="w-full h-auto object-cover rounded-lg group-hover:scale-102 transition-transform duration-300" />
                </div>
                <span class="text-[11px] text-[var(--text-muted)] mt-2 font-medium italic text-center">
                    @if($hasRealPhoto)
                        {{ $page->getTranslated('title') }} — Universidad Nacional Agraria La Molina
                    @else
                        {{ ($currentLocale ?? 'es') === 'en' ? 'Official reference image (Photo pending upload) — UNALM' : 'Fotografía oficial de referencia (Pendiente de carga) — UNALM' }}
                    @endif
                </span>
            </div>

            <!-- Enlace oficial externo si existe -->
            @if($page->external_url)
                <div class="pt-6 border-t border-[var(--border-color)] flex flex-col sm:flex-row items-center justify-between gap-4">
                    <span class="text-xs text-[var(--text-muted)]">Para más información oficial sobre esta red o asociación:</span>
                    <a href="{{ $page->external_url }}" target="_blank" rel="noopener noreferrer" class="btn-molinero text-xs py-2.5 px-5 flex items-center gap-2 shadow-md">
                        <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Visit Official Portal' : 'Visitar Portal Oficial' }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            @endif
        </div>

        <!-- Secciones Relacionadas / Otras Páginas de la Red -->
        @if(isset($relatedPages) && $relatedPages->isNotEmpty())
            <div class="mt-12 space-y-4">
                <div class="flex items-center justify-between border-b border-[var(--border-color)] pb-3">
                    <h3 class="text-sm font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                        <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Other Pages in this Section' : 'Otras Páginas en esta Sección' }}</span>
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($relatedPages as $relPage)
                        <a href="{{ route('pages.show', $relPage->slug) }}" class="p-4 rounded-xl border border-[var(--border-color)] bg-[var(--bg-surface)] hover:border-emerald-600 hover:shadow-lg transition-all group flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-emerald-700 dark:text-emerald-400 uppercase">{{ $relPage->section_label }}</span>
                                <h4 class="text-xs font-bold text-[var(--text-primary)] group-hover:text-[#0F5132] dark:group-hover:text-emerald-400 mt-1 leading-snug">
                                    {{ $relPage->getTranslated('title') }}
                                </h4>
                                @if($relPage->getTranslated('summary'))
                                    <p class="text-[11px] text-[var(--text-muted)] line-clamp-2 mt-2 leading-relaxed">
                                        {{ $relPage->getTranslated('summary') }}
                                    </p>
                                @endif
                            </div>
                            <span class="mt-3 text-[11px] font-semibold text-emerald-700 dark:text-emerald-400 flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Read more' : 'Ver página' }}</span>
                                <span>→</span>
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</section>
@endsection


@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'Office of Inter-institutional Management and Global Affairs' : 'Oficina de Gestión Interinstitucional y Asuntos Globales')

@section('content')
<!-- Hero Institucional Dinámico -->
@php
    $heroMediaType = \App\Models\SiteSetting::get('hero_media_type', 'image');
    $heroImagePath = \App\Models\SiteSetting::get('hero_image_path', 'imagenes/portadas/portada1.png');
    $heroVideoPath = \App\Models\SiteSetting::get('hero_video_path');
    $heroVideoYt = \App\Models\SiteSetting::get('hero_video_youtube');
    $heroOpacity = (int)\App\Models\SiteSetting::get('hero_overlay_opacity', '65');
    $opacityVal = max(0.3, min(0.9, $heroOpacity / 100));
    $headerOverlay = \App\Models\SiteSetting::get('hero_header_overlay', 'overlay');
    $isOverlay = ($headerOverlay === 'overlay' || $headerOverlay === '1');
@endphp

<section class="relative {{ $isOverlay ? 'min-h-[580px] lg:min-h-[660px] pt-36 sm:pt-44 pb-20 sm:pb-28' : 'min-h-[520px] lg:min-h-[580px] py-20 sm:py-28' }} flex items-center bg-gradient-to-b from-emerald-950 via-[#0F5132] to-[#0A3622] text-white overflow-hidden transition-all duration-300">
    @if($heroMediaType === 'carousel')
        <!-- Fondo de Carrusel Dinámico de Fotografías -->
        @php
            $carouselBanners = \App\Models\BannerImage::activeCarousel()->get();
        @endphp
        @if($carouselBanners->isNotEmpty())
            <div id="hero-carousel-container" class="absolute inset-0 w-full h-full z-0 overflow-hidden">
                @foreach($carouselBanners as $idx => $banner)
                    <div class="hero-carousel-slide absolute inset-0 w-full h-full transition-opacity duration-1000 ease-in-out {{ $idx === 0 ? 'opacity-100 z-1' : 'opacity-0 z-0 pointer-events-none' }}" data-index="{{ $idx }}">
                        <img src="{{ asset($banner->image_path) }}" alt="{{ $banner->getTranslated('title') }}" class="w-full h-full object-cover object-center scale-105" />
                    </div>
                @endforeach
            </div>
            <!-- Controles e Indicadores del Carrusel -->
            @if($carouselBanners->count() > 1)
            <div class="absolute bottom-6 right-8 z-20 flex items-center gap-2">
                @foreach($carouselBanners as $idx => $banner)
                    <button type="button" onclick="setHeroSlide({{ $idx }})" class="hero-carousel-indicator h-2.5 rounded-full transition-all duration-300 {{ $idx === 0 ? 'bg-[#D4AF37] w-7' : 'bg-white/60 hover:bg-white w-2.5' }}" title="{{ $banner->getTranslated('title') }}" aria-label="Foto {{ $idx + 1 }}"></button>
                @endforeach
            </div>
            @endif
        @else
            <!-- Fallback a imagen si no hay fotos activas en el carrusel -->
            <img src="{{ asset($heroImagePath ?: 'imagenes/portadas/portada1.png') }}" alt="Campus UNALM" class="absolute inset-0 w-full h-full object-cover object-center z-0 scale-105" />
        @endif
        <div class="absolute inset-0 z-1" style="background-color: rgba(10, 38, 24, {{ $opacityVal }});"></div>
        <div class="absolute inset-0 z-1 bg-gradient-to-t from-[#0A3622] via-transparent to-black/40"></div>
    @elseif($heroMediaType === 'image' && $heroImagePath)
        <!-- Fondo de Fotografía Institucional -->
        <img src="{{ asset($heroImagePath) }}" alt="Campus UNALM" class="absolute inset-0 w-full h-full object-cover object-center z-0 scale-105 transition-transform duration-1000" />
        <div class="absolute inset-0 z-1" style="background-color: rgba(10, 38, 24, {{ $opacityVal }});"></div>
        <div class="absolute inset-0 z-1 bg-gradient-to-t from-[#0A3622] via-transparent to-black/40"></div>
    @elseif($heroMediaType === 'video' && $heroVideoPath)
        <!-- Fondo de Video Institucional en Bucle -->
        <video autoplay muted loop playsinline poster="{{ asset($heroImagePath ?: 'imagenes/portadas/portada1.png') }}" class="absolute inset-0 w-full h-full object-cover z-0">
            <source src="{{ asset($heroVideoPath) }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 z-1" style="background-color: rgba(10, 38, 24, {{ $opacityVal }});"></div>
        <div class="absolute inset-0 z-1 bg-gradient-to-t from-[#0A3622] via-transparent to-black/40"></div>
    @elseif($heroMediaType === 'youtube' && $heroVideoYt)
        <!-- Fondo con video de YouTube -->
        @php
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $heroVideoYt, $matches);
            $ytId = $matches[1] ?? $heroVideoYt;
        @endphp
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none opacity-40">
            <iframe class="w-full h-full scale-150" src="https://www.youtube-nocookie.com/embed/{{ $ytId }}?autoplay=1&mute=1&controls=0&loop=1&playlist={{ $ytId }}&showinfo=0&rel=0" frameborder="0" allow="autoplay; encrypted-media"></iframe>
        </div>
        <div class="absolute inset-0 z-1" style="background-color: rgba(10, 38, 24, {{ $opacityVal }});"></div>
    @else
        <!-- Fondo de Patrón y Degradado Molinero -->
        <div class="absolute inset-0 opacity-15 pointer-events-none bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px]"></div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="max-w-3xl">
            <!-- Insignia -->
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-200 text-xs font-semibold mb-6 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-[#D4AF37] animate-pulse"></span>
                <span>{{ \App\Models\SiteSetting::get('hero_badge', 'Internacionalización & Cooperación Global', $currentLocale ?? 'es') }}</span>
            </div>

            <!-- Título Principal -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight text-white mb-6 drop-shadow-md">
                {{ \App\Models\SiteSetting::get('hero_title', 'Oficina de Gestión Interinstitucional y Asuntos Globales', $currentLocale ?? 'es') }}
            </h1>

            <!-- Bajada / Subtítulo -->
            <p class="text-base sm:text-lg text-emerald-100/95 leading-relaxed mb-8 drop-shadow-sm">
                {{ \App\Models\SiteSetting::get('hero_subtitle', 'Lideramos la cooperación interinstitucional, la investigación científica transnacional y las oportunidades de movilidad académica para la comunidad de la Universidad Nacional Agraria La Molina.', $currentLocale ?? 'es') }}
            </p>

            <!-- Botones de Acción -->
            <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                <a href="{{ route('agreements.international') }}" class="inline-flex items-center gap-2 bg-[#D4AF37] hover:bg-[#b89528] text-gray-950 font-bold text-sm px-6 py-3 rounded-lg shadow-xl transform hover:-translate-y-0.5 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                    <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Explore Agreements' : 'Explorar Convenios y Redes' }}</span>
                </a>
                <a href="{{ route('mobility.outgoing') }}" class="inline-flex items-center justify-center font-bold text-sm px-6 py-3 rounded-lg border-2 border-white/90 bg-white/10 hover:bg-white text-white hover:text-[#0F5132] shadow-lg backdrop-blur-md transition-all">
                    <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Outgoing Mobility' : 'Movilidad Saliente' }}</span>
                </a>
                <a href="{{ route('mobility.incoming') }}" class="inline-flex items-center justify-center font-bold text-sm px-5 py-3 rounded-lg border-2 border-emerald-400 bg-emerald-950/60 hover:bg-emerald-500 text-emerald-100 hover:text-white shadow-lg backdrop-blur-md transition-all">
                    <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Study at UNALM' : 'Estudia en la UNALM' }}</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Barra de Estadísticas Institucionales Reales -->
<section class="bg-[var(--bg-surface)] border-b border-[var(--border-color)] py-8 relative -mt-6 mx-4 sm:mx-8 lg:mx-auto max-w-7xl rounded-xl shadow-lg z-20">
    <div class="px-6 sm:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
            <div class="border-r border-[var(--border-color)] last:border-none">
                <span class="block text-3xl sm:text-4xl font-extrabold text-[#0F5132] dark:text-emerald-400">{{ $stats['countries'] }}</span>
                <span class="text-xs sm:text-sm text-[var(--text-muted)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Partner Countries' : 'Países Socios' }}</span>
            </div>
            <div class="border-r border-[var(--border-color)] last:border-none">
                <span class="block text-3xl sm:text-4xl font-extrabold text-[#0F5132] dark:text-emerald-400">{{ $stats['agreements'] }}</span>
                <span class="text-xs sm:text-sm text-[var(--text-muted)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Active Agreements' : 'Convenios Vigentes' }}</span>
            </div>
            <div class="border-r border-[var(--border-color)] last:border-none">
                <span class="block text-3xl sm:text-4xl font-extrabold text-[#0F5132] dark:text-emerald-400">{{ $stats['calls'] }}</span>
                <span class="text-xs sm:text-sm text-[var(--text-muted)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Open Calls' : 'Convocatorias Abiertas' }}</span>
            </div>
            <div>
                <span class="block text-3xl sm:text-4xl font-extrabold text-[#0F5132] dark:text-emerald-400">{{ $stats['faculties'] }}</span>
                <span class="text-xs sm:text-sm text-[var(--text-muted)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Academic Programs' : 'Carreras Profesionales' }}</span>
            </div>
        </div>
    </div>
</section>

<!-- Accesos Directos Principales -->
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto mb-12">
        <span class="text-xs uppercase font-bold text-[#0F5132] dark:text-emerald-400 tracking-wider">{{ ($currentLocale ?? 'es') === 'en' ? 'Strategic Focus' : 'Ejes Estratégicos' }}</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-[var(--text-primary)] mt-1">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Opportunities for the University Community' : 'Oportunidades para la Comunidad Molinera' }}
        </h2>
        <p class="text-sm text-[var(--text-muted)] mt-2">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Access mobility calls, multilateral agreements, and guidance for international stays.' : 'Accede a las convocatorias de movilidad, convenios multilaterales y asesoría para estancias en el extranjero.' }}
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Tarjeta 1: Movilidad Saliente -->
        <div class="card-molinero flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-lg bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center text-[#0F5132] dark:text-emerald-400 mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </div>
                <h3 class="text-lg font-bold text-[var(--text-primary)] mb-2">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Study Abroad (UNALM Students)' : 'Estudia en el Extranjero' }}
                </h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed mb-6">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Complete an exchange semester through scholarships or personal funds at partner universities in Europe, Asia, and the Americas.' : 'Realiza un semestre de intercambio mediante beca o recursos propios en universidades de Europa, Asia y las Américas.' }}
                </p>
            </div>
            <a href="{{ route('mobility.outgoing') }}" class="btn-molinero text-xs w-full">
                {{ ($currentLocale ?? 'es') === 'en' ? 'View Requirements & Steps' : 'Ver Requisitos y Proceso' }}
            </a>
        </div>

        <!-- Tarjeta 2: Directorio de Convenios -->
        <div class="card-molinero flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-lg bg-amber-100 dark:bg-amber-950/60 flex items-center justify-center text-amber-600 dark:text-amber-400 mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-[var(--text-primary)] mb-2">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Agreements Directory' : 'Directorio de Convenios' }}
                </h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed mb-6">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Explore over 74 active agreements with institutions across 19 countries, filtered by university, field, and agreement type.' : 'Consulta los más de 74 convenios vigentes con instituciones de 19 países, filtrados por universidad, área y tipo de acuerdo.' }}
                </p>
            </div>
            <a href="{{ route('agreements.international') }}" class="btn-molinero text-xs w-full">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Search Agreements' : 'Buscar Convenios Activos' }}
            </a>
        </div>

        <!-- Tarjeta 3: Movilidad Entrante -->
        <div class="card-molinero flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-lg bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center text-[#0F5132] dark:text-emerald-400 mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-[var(--text-primary)] mb-2">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Study at UNALM (International Students)' : 'Estudia en la UNALM' }}
                </h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed mb-6">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Information for international students interested in completing an academic stay at our Lima campus.' : 'Información para estudiantes internacionales interesados en cursar una estancia académica en nuestro campus de Lima.' }}
                </p>
            </div>
            <a href="{{ route('mobility.incoming') }}" class="btn-molinero text-xs w-full">
                {{ ($currentLocale ?? 'es') === 'en' ? 'International Student Guide' : 'Guía para Estudiantes Extranjeros' }}
            </a>
        </div>
    </div>
</section>

<!-- Convocatorias Destacadas -->
@if($featuredCalls->count() > 0)
<section class="py-12 bg-[var(--bg-surface)] border-y border-[var(--border-color)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 gap-4">
            <div>
                <span class="text-xs uppercase font-bold text-[#0F5132] dark:text-emerald-400 tracking-wider">{{ ($currentLocale ?? 'es') === 'en' ? 'Open Opportunities' : 'Oportunidades Abiertas' }}</span>
                <h2 class="text-2xl font-extrabold text-[var(--text-primary)] mt-1">{{ ($currentLocale ?? 'es') === 'en' ? 'Active Scholarships & Calls' : 'Becas y Convocatorias Vigentes' }}</h2>
            </div>
            <a href="{{ route('calls.index') }}" class="text-xs font-semibold text-[#0F5132] dark:text-emerald-400 hover:underline inline-flex items-center gap-1">
                {{ ($currentLocale ?? 'es') === 'en' ? 'View all calls' : 'Ver todas las convocatorias' }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($featuredCalls as $call)
            <div class="card-molinero flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="badge-status badge-vigente">{{ ($currentLocale ?? 'es') === 'en' ? 'Open Call' : 'Convocatoria Abierta' }}</span>
                        @if($call->deadline_date)
                        <span class="text-[11px] text-[var(--text-muted)] font-medium">
                            {{ ($currentLocale ?? 'es') === 'en' ? 'Deadline: ' . $call->deadline_date->format('M d, Y') : 'Cierre: ' . $call->deadline_date->format('d/m/Y') }}
                        </span>
                        @endif
                    </div>
                    <h3 class="text-base font-bold text-[var(--text-primary)] mb-2 line-clamp-2">
                        {{ $call->trans('title') }}
                    </h3>
                    <p class="text-xs text-[var(--text-secondary)] line-clamp-3 mb-4">
                        {{ $call->trans('summary') }}
                    </p>
                </div>
                <a href="{{ route('calls.show', $call->slug) }}" class="btn-molinero-outline text-xs text-center w-full">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'View Guidelines & Requirements' : 'Ver Bases y Requisitos' }}
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Noticias y Visitas Institucionales -->
@if($recentNews->count() > 0)
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 gap-4">
        <div>
            <span class="text-xs uppercase font-bold text-[#0F5132] dark:text-emerald-400 tracking-wider">{{ ($currentLocale ?? 'es') === 'en' ? 'Press Room' : 'Sala de Prensa' }}</span>
            <h2 class="text-2xl font-extrabold text-[var(--text-primary)] mt-1">{{ ($currentLocale ?? 'es') === 'en' ? 'Cooperation & Agreement News' : 'Noticias de Cooperación y Acuerdos' }}</h2>
        </div>
        <a href="{{ route('news.index') }}" class="text-xs font-semibold text-[#0F5132] dark:text-emerald-400 hover:underline inline-flex items-center gap-1">
            {{ ($currentLocale ?? 'es') === 'en' ? 'View news archive' : 'Ver archivo de noticias' }}
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

    @php
        $categoryMap = [
            'convenio' => 'Agreement',
            'movilidad' => 'Mobility',
            'visita' => 'Visit',
            'evento' => 'Event',
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($recentNews as $article)
        <article class="card-molinero flex flex-col justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-1 block">
                    {{ ($currentLocale ?? 'es') === 'en' ? ($categoryMap[strtolower($article->category)] ?? ucfirst($article->category)) : ucfirst($article->category) }} • {{ $article->published_at->format(($currentLocale ?? 'es') === 'en' ? 'M d, Y' : 'd/m/Y') }}
                </span>
                <h3 class="text-base font-bold text-[var(--text-primary)] mb-2 line-clamp-2">
                    <a href="{{ route('news.show', $article->slug) }}" class="hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                        {{ $article->trans('title') }}
                    </a>
                </h3>
                <p class="text-xs text-[var(--text-secondary)] line-clamp-3 mb-4">
                    {{ $article->trans('summary') }}
                </p>
            </div>
            <a href="{{ route('news.show', $article->slug) }}" class="text-xs font-semibold text-[#0F5132] dark:text-emerald-400 hover:underline">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Read full article →' : 'Leer noticia completa →' }}
            </a>
        </article>
        @endforeach
    </div>
</section>
@endif

<!-- Aliados Estratégicos y Redes de Cooperación (Diseño Oficial) -->
<section class="py-16 bg-white dark:bg-[#0B1410] border-t border-[var(--border-color)] transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0F5132] dark:text-emerald-400 uppercase tracking-wider">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Strategic Partners' : 'Aliados Estratégicos' }}
            </h2>
            <div class="flex items-center justify-center gap-2 mt-3">
                <span class="w-14 sm:w-20 h-0.5 bg-[#0F5132] dark:bg-emerald-400"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-[#0F5132] dark:bg-emerald-400"></span>
                <span class="w-14 sm:w-20 h-0.5 bg-[#0F5132] dark:bg-emerald-400"></span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 items-stretch">
            @foreach($partners as $partner)
            @php
                $partnerLogo = ($partner->logo_path && file_exists(public_path($partner->logo_path))) 
                    ? asset($partner->logo_path) 
                    : asset(($currentLocale ?? 'es') === 'en' ? 'imagenes/placeholder_referencia_en.svg' : 'imagenes/placeholder_referencia.svg');
            @endphp
            <div class="bg-white dark:bg-[#121F19] rounded-2xl border border-gray-200 dark:border-emerald-900/50 shadow-md hover:shadow-xl p-6 sm:p-8 h-44 sm:h-48 flex items-center justify-center transition-all duration-300 group">
                @if($partner->website_url)
                <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="w-full h-full flex items-center justify-center dark:bg-white dark:rounded-xl dark:p-3" title="{{ $partner->name }}">
                    <img src="{{ $partnerLogo }}" alt="{{ $partner->name }}" class="max-h-24 sm:max-h-28 w-auto max-w-[85%] object-contain group-hover:scale-105 transition-transform duration-300" />
                </a>
                @else
                <div class="w-full h-full flex items-center justify-center dark:bg-white dark:rounded-xl dark:p-3">
                    <img src="{{ $partnerLogo }}" alt="{{ $partner->name }}" class="max-h-24 sm:max-h-28 w-auto max-w-[85%] object-contain group-hover:scale-105 transition-transform duration-300" />
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Preguntas Frecuentes Destacadas -->
@if($faqs->count() > 0)
<section class="py-16 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10">
        <span class="text-xs uppercase font-bold text-[#0F5132] dark:text-emerald-400 tracking-wider">{{ ($currentLocale ?? 'es') === 'en' ? 'Guidance' : 'Orientación' }}</span>
        <h2 class="text-2xl font-extrabold text-[var(--text-primary)] mt-1">{{ ($currentLocale ?? 'es') === 'en' ? 'Frequently Asked Questions about Mobility & Agreements' : 'Preguntas Frecuentes sobre Movilidad y Convenios' }}</h2>
    </div>

    <div class="space-y-4">
        @foreach($faqs as $faq)
        <div class="card-molinero p-5">
            <h3 class="text-sm font-bold text-[var(--text-primary)] mb-2 flex items-start gap-2">
                <span class="text-[#0F5132] dark:text-emerald-400 font-extrabold">Q.</span>
                <span>{{ ($currentLocale ?? 'es') === 'en' && $faq->question_en ? $faq->question_en : $faq->question }}</span>
            </h3>
            <p class="text-xs text-[var(--text-secondary)] leading-relaxed pl-6">
                {{ ($currentLocale ?? 'es') === 'en' && $faq->answer_en ? $faq->answer_en : $faq->answer }}
            </p>
        </div>
        @endforeach
    </div>
</section>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.hero-carousel-slide');
    const indicators = document.querySelectorAll('.hero-carousel-indicator');
    if (slides.length <= 1) return;

    let currentSlide = 0;
    let timer = null;

    function showSlide(index) {
        slides.forEach((s, i) => {
            if (i === index) {
                s.classList.remove('opacity-0', 'z-0', 'pointer-events-none');
                s.classList.add('opacity-100', 'z-1');
            } else {
                s.classList.remove('opacity-100', 'z-1');
                s.classList.add('opacity-0', 'z-0', 'pointer-events-none');
            }
        });

        indicators.forEach((ind, i) => {
            if (i === index) {
                ind.className = 'hero-carousel-indicator h-2.5 rounded-full transition-all duration-300 bg-[#D4AF37] w-7';
            } else {
                ind.className = 'hero-carousel-indicator h-2.5 rounded-full transition-all duration-300 bg-white/60 hover:bg-white w-2.5';
            }
        });
        currentSlide = index;
    }

    function nextSlide() {
        showSlide((currentSlide + 1) % slides.length);
    }

    function startTimer() {
        if (timer) clearInterval(timer);
        timer = setInterval(nextSlide, 5500);
    }

    window.setHeroSlide = function(idx) {
        showSlide(idx);
        startTimer();
    };

    startTimer();
});
</script>
@endsection

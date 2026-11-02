<!DOCTYPE html>
<html lang="{{ $currentLocale ?? 'es' }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', ($currentLocale ?? 'es') === 'en' ? 'Office of Inter-institutional Management and Global Affairs (OGI) — Universidad Nacional Agraria La Molina. International agreements, student mobility, and scientific cooperation.' : 'Oficina de Gestión Interinstitucional y Asuntos Globales (OGI) — Universidad Nacional Agraria La Molina. Convenios internacionales, movilidad estudiantil y cooperación científica.')">
    <meta name="author" content="Universidad Nacional Agraria La Molina">
    <title>@yield('title', 'OGI') — {{ ($currentLocale ?? 'es') === 'en' ? 'Office of Inter-institutional Management and Global Affairs' : 'Oficina de Gestión Interinstitucional' }} | UNALM</title>

    <!-- Preconnect & Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Open Graph / Meta -->
    <meta property="og:title" content="@yield('title', ($currentLocale ?? 'es') === 'en' ? 'OGI UNALM — Global Affairs & Agreements' : 'OGI UNALM — Asuntos Globales y Convenios')">
    <meta property="og:description" content="@yield('meta_description', ($currentLocale ?? 'es') === 'en' ? 'Official portal for international agreements, academic mobility, and global cooperation at Universidad Nacional Agraria La Molina.' : 'Portal oficial de convenios, movilidad académica y cooperación internacional de la Universidad Nacional Agraria La Molina.')">
    <meta property="og:image" content="{{ asset('imagenes/Logotipo_unalm.jpg') }}">
    <meta property="og:type" content="website">

    <!-- Styles and Scripts compiled via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Script inicial anti-flicker para tema -->
    <script>
        (function() {
            const stored = localStorage.getItem('ogi_theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (stored === 'dark' || (!stored && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>
<body class="min-h-screen flex flex-col bg-[var(--bg-page)] text-[var(--text-primary)] antialiased transition-colors duration-200">
    <a href="#contenido-principal" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:bg-[#0F5132] focus:text-white focus:px-4 focus:py-2 focus:rounded-md focus:shadow-lg focus:outline-none">
        {{ ($currentLocale ?? 'es') === 'en' ? 'Skip to main content' : 'Saltar al contenido principal' }}
    </a>

    @php
        $headerOverlaySetting = \App\Models\SiteSetting::get('hero_header_overlay', 'overlay');
        $isOverlayActive = ($headerOverlaySetting === '1' || $headerOverlaySetting === 'overlay') && request()->routeIs('home');
    @endphp

    <!-- Contenedor de Cabecera (Soporta Modo Superposición Inmersivo y Modo Estándar) -->
    <div class="{{ $isOverlayActive ? 'header-overlay-wrapper' : '' }}">
        <!-- Barra Superior Institucional -->
        <div class="header-topbar bg-[#0A3622] text-emerald-100 text-xs py-1.5 px-4 sm:px-6 border-b border-emerald-900/60 transition-all duration-300">
            <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center gap-2">
                <div class="flex items-center gap-4">
                    <span class="font-medium tracking-wide">Universidad Nacional Agraria La Molina</span>
                    <span class="hidden md:inline text-emerald-500">|</span>
                    <span class="hidden md:inline text-emerald-300">{{ ($currentLocale ?? 'es') === 'en' ? 'Office of Inter-institutional Management and Global Affairs (OGI)' : 'Oficina de Gestión Interinstitucional y Asuntos Globales (OGI)' }}</span>
                </div>
                <div class="flex items-center gap-3">
                    <a href="https://www.lamolina.edu.pe" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors">
                        {{ ($currentLocale ?? 'es') === 'en' ? 'UNALM Central Portal' : 'Portal Central UNALM' }}
                    </a>
                    <span class="text-emerald-700">|</span>
                    <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-1 text-emerald-200 hover:text-white font-medium transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        {{ ($currentLocale ?? 'es') === 'en' ? 'CMS Intranet' : 'Intranet CMS' }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Cabecera Principal con Navegación Sticky -->
        <header class="header-sticky header-main {{ $isOverlayActive ? '' : 'sticky top-0' }} z-40 bg-[var(--bg-surface)]/95 backdrop-blur-md border-b border-[var(--border-color)] transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <!-- Logotipos Institucionales -->
                    <div class="flex items-center gap-3 sm:gap-4 flex-shrink-0">
                        <a href="{{ route('home') }}" class="flex items-center gap-3 group" title="{{ ($currentLocale ?? 'es') === 'en' ? 'Home Portal OGI UNALM' : 'Inicio Portal OGI UNALM' }}">
                            <!-- Modo Superposición inicial: logo letras blancas de alto contraste -->
                            <img src="{{ asset('imagenes/logo_footer.png') }}" alt="Escudo de la Universidad Nacional Agraria La Molina" class="logo-on-overlay hidden h-11 sm:h-12 w-auto object-contain" />
                            <!-- Modo Claro estándar: logo_trans.png (letras oscuras, fondo transparente) -->
                            <img src="{{ asset('imagenes/logo_trans.png') }}" alt="Escudo de la Universidad Nacional Agraria La Molina" class="logo-light-mode h-11 sm:h-12 w-auto object-contain" />
                            <!-- Modo Oscuro estándar: logo_footer.png (letras blancas, fondo transparente) -->
                            <img src="{{ asset('imagenes/logo_footer.png') }}" alt="Escudo de la Universidad Nacional Agraria La Molina" class="logo-dark-mode h-11 sm:h-12 w-auto object-contain" />
                            <div class="header-brand-divider border-l border-[var(--border-color)] pl-3 pr-2">
                                <span class="header-brand-title block text-sm sm:text-base font-bold text-[#0F5132] dark:text-emerald-400 leading-tight">OGI — UNALM</span>
                                <span class="header-brand-subtitle block text-[11px] sm:text-xs text-[var(--text-muted)] font-medium leading-tight">{{ ($currentLocale ?? 'es') === 'en' ? 'Inter-institutional Management' : 'Gestión Interinstitucional' }}</span>
                            </div>
                        </a>
                    </div>

                    <!-- Navegación Principal en Escritorio -->
                    <nav class="hidden lg:flex items-center gap-1 xl:gap-2 text-xs xl:text-sm font-medium ml-8 xl:ml-12">
                        <a href="{{ route('home') }}" class="nav-link-btn px-3 py-2 rounded-md whitespace-nowrap transition-colors {{ request()->routeIs('home') ? 'nav-link-active text-[#0F5132] dark:text-emerald-400 font-bold border-b-2 border-[#0F5132] dark:border-emerald-400 rounded-none' : 'text-[var(--text-secondary)] hover:text-[#0F5132] dark:hover:text-emerald-400' }}">
                            {{ ($currentLocale ?? 'es') === 'en' ? 'Home' : 'Inicio' }}
                        </a>

                        <!-- Dropdown La OGI -->
                        <div class="relative group">
                            <button class="nav-link-btn px-3 py-2 rounded-md text-[var(--text-secondary)] hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors flex items-center gap-1 whitespace-nowrap" aria-haspopup="true">
                                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'About OGI' : 'La OGI' }}</span>
                                <svg class="w-3.5 h-3.5 text-gray-400 group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="absolute left-0 top-full pt-1 opacity-0 translate-y-1 invisible group-hover:opacity-100 group-hover:translate-y-0 group-hover:visible transition-all duration-200 w-64 z-50">
                                <div class="bg-[var(--bg-surface)] rounded-xl shadow-2xl border border-[var(--border-color)] p-2 space-y-1">
                                    <a href="{{ route('ogi.presentation') }}" class="group/item block px-3 py-2 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                        <span class="block font-semibold text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Institutional Presentation' : 'Presentación y Propósito' }}</span>
                                        <span class="block text-[10px] text-[var(--text-muted)] group-hover/item:text-emerald-700 dark:group-hover/item:text-emerald-200">{{ ($currentLocale ?? 'es') === 'en' ? 'Mission, background and scope' : 'Misión, historia y alcance de la OGI' }}</span>
                                    </a>
                                    <a href="{{ route('ogi.mission_vision') }}" class="group/item block px-3 py-2 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                        <span class="block font-semibold text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Mission & Vision' : 'Misión, Visión y Valores' }}</span>
                                        <span class="block text-[10px] text-[var(--text-muted)] group-hover/item:text-emerald-700 dark:group-hover/item:text-emerald-200">{{ ($currentLocale ?? 'es') === 'en' ? 'Institutional strategic guidelines' : 'Lineamientos estratégicos UNALM' }}</span>
                                    </a>
                                    <a href="{{ route('ogi.team') }}" class="group/item block px-3 py-2 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                        <span class="block font-semibold text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Management Team' : 'Equipo de Gestión' }}</span>
                                        <span class="block text-[10px] text-[var(--text-muted)] group-hover/item:text-emerald-700 dark:group-hover/item:text-emerald-200">{{ ($currentLocale ?? 'es') === 'en' ? 'Directors and offices' : 'Directores y coordinaciones' }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Dropdown Convenios y Redes Dinámico -->
                        @php
                            $navCustomPages = \App\Models\CustomPage::inNav()->ordered()->get()->groupBy('nav_section');
                        @endphp
                        <div class="relative group">
                            <button class="nav-link-btn px-3 py-2 rounded-md text-[var(--text-secondary)] hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors flex items-center gap-1 whitespace-nowrap" aria-haspopup="true">
                                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Agreements & Networks' : 'Convenios y Redes' }}</span>
                                <svg class="w-3.5 h-3.5 text-gray-400 group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="absolute left-0 top-full pt-1 opacity-0 translate-y-1 invisible group-hover:opacity-100 group-hover:translate-y-0 group-hover:visible transition-all duration-200 w-[540px] z-50">
                                <div class="bg-[var(--bg-surface)] rounded-xl shadow-2xl border border-[var(--border-color)] p-3 grid grid-cols-2 gap-3 divide-x divide-[var(--border-color)]">
                                    
                                    <!-- Columna 1: Convenios y Alianzas Generales -->
                                    <div class="space-y-1">
                                        <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-[var(--text-muted)] block">
                                            {{ ($currentLocale ?? 'es') === 'en' ? 'Agreements Directory' : 'Directorios de Convenios' }}
                                        </span>
                                        <a href="{{ route('agreements.international') }}" class="group/item block px-3 py-2 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                            <span class="block font-semibold text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'International Agreements' : 'Convenios Internacionales' }}</span>
                                            <span class="block text-[10px] text-[var(--text-muted)] group-hover/item:text-emerald-700 dark:group-hover/item:text-emerald-200">{{ ($currentLocale ?? 'es') === 'en' ? 'Agreements in 19+ countries' : 'Acuerdos en 19+ países del mundo' }}</span>
                                        </a>
                                        <a href="{{ route('agreements.national') }}" class="group/item block px-3 py-2 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                            <span class="block font-semibold text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'National Agreements' : 'Convenios Nacionales' }}</span>
                                            <span class="block text-[10px] text-[var(--text-muted)] group-hover/item:text-emerald-700 dark:group-hover/item:text-emerald-200">{{ ($currentLocale ?? 'es') === 'en' ? 'Public and private Peruvian institutions' : 'Entidades públicas y privadas peruanas' }}</span>
                                        </a>
                                        <a href="{{ route('agreements.networks') }}" class="group/item block px-3 py-2 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                            <span class="block font-semibold text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Academic Networks & Allies' : 'Redes y Aliados Estratégicos' }}</span>
                                            <span class="block text-[10px] text-[var(--text-muted)] group-hover/item:text-emerald-700 dark:group-hover/item:text-emerald-200">{{ ($currentLocale ?? 'es') === 'en' ? 'Strategic partnerships overview' : 'Consorcios y cooperaciones vigentes' }}</span>
                                        </a>
                                    </div>

                                    <!-- Columna 2: Redes Institucionales Dinámicas (IAAS, IFSA, RUNAI...) -->
                                    <div class="pl-3 space-y-2 max-h-[360px] overflow-y-auto">
                                        @if($navCustomPages->isNotEmpty())
                                            @foreach($navCustomPages as $secKey => $pagesGroup)
                                                @php
                                                    $secTitle = ($currentLocale ?? 'es') === 'en' 
                                                        ? (\App\Models\CustomPage::$navSectionsEn[$secKey] ?? ucfirst(str_replace('_', ' ', $secKey)))
                                                        : (\App\Models\CustomPage::$navSections[$secKey] ?? ucfirst(str_replace('_', ' ', $secKey)));
                                                @endphp
                                                <div>
                                                    <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 rounded block mb-1">
                                                        {{ $secTitle }}
                                                    </span>
                                                    <div class="space-y-0.5">
                                                        @foreach($pagesGroup as $cp)
                                                            <a href="{{ route('pages.show', $cp->slug) }}" class="group/item flex items-center justify-between px-2.5 py-1.5 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                                                <span class="font-medium text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white truncate max-w-[210px]">
                                                                    {{ $cp->getTranslated('title') }}
                                                                </span>
                                                                <svg class="w-3 h-3 text-emerald-600 opacity-0 group-hover/item:opacity-100 transition-opacity flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="p-4 text-center text-xs text-[var(--text-muted)]">
                                                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Manage networks from the Intranet.' : 'Gestione redes desde la Intranet.' }}</span>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Dropdown Movilidad (Conforme a Foto 1 y Foto 2 y Full Administrable) -->
                        <div class="relative group">
                            <button class="nav-link-btn px-3 py-2 rounded-md text-[var(--text-secondary)] hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors flex items-center gap-1 whitespace-nowrap {{ request()->is('movilidad*') || request()->is('summer-camp*') ? 'nav-link-active text-[#0F5132] dark:text-emerald-400 font-bold border-b-2 border-[#0F5132] dark:border-emerald-400 rounded-none' : '' }}" aria-haspopup="true">
                                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Academic Mobility' : 'Movilidad' }}</span>
                                <svg class="w-3.5 h-3.5 text-gray-400 group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <!-- Menú Nivel 1 -->
                            <div class="absolute left-0 top-full pt-1 opacity-0 translate-y-1 invisible group-hover:opacity-100 group-hover:translate-y-0 group-hover:visible transition-all duration-200 w-72 z-50">
                                <div class="bg-[var(--bg-surface)] rounded-xl shadow-2xl border border-[var(--border-color)] p-2 space-y-1">
                                    
                                    <!-- NIVEL 2: Movilidad Entrante (Incoming) con Submenú Flyout a la derecha -->
                                    <div class="relative group/subentrante">
                                        <div class="flex items-center justify-between px-3 py-2.5 rounded-lg text-xs font-semibold text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white cursor-pointer transition-all">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                                                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Incoming Mobility (Incoming)' : 'Movilidad Entrante (Incoming)' }}</span>
                                            </div>
                                            <svg class="w-3.5 h-3.5 text-gray-400 group-hover/subentrante:text-[#0F5132] dark:group-hover/subentrante:text-white group-hover/subentrante:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </div>

                                        <!-- Submenú Nivel 3 Flyout Derecha -->
                                        <div class="absolute left-full top-0 ml-1.5 opacity-0 -translate-x-2 invisible group-hover/subentrante:opacity-100 group-hover/subentrante:translate-x-0 group-hover/subentrante:visible transition-all duration-200 w-80 z-50">
                                            <div class="bg-[var(--bg-surface)] rounded-xl shadow-2xl border border-[var(--border-color)] p-2 space-y-1">
                                                <a href="{{ route('mobility.incoming') }}" class="group/item flex items-center justify-between px-3 py-2 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                                    <span class="font-medium text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Study at UNALM' : 'Estudia en la UNALM' }}</span>
                                                    <svg class="w-3 h-3 opacity-0 group-hover/item:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                </a>
                                                <a href="{{ route('mobility.special_programs') }}" class="group/item flex items-center justify-between px-3 py-2 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                                    <span class="font-medium text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Special Programs' : 'Programas especiales' }}</span>
                                                    <svg class="w-3 h-3 opacity-0 group-hover/item:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                </a>
                                                <a href="{{ route('mobility.testimonies') }}" class="group/item flex items-center justify-between px-3 py-2 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                                    <span class="font-medium text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Foreign Student Testimonials' : 'Testimonio de los alumnos extranjeros' }}</span>
                                                    <svg class="w-3 h-3 opacity-0 group-hover/item:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                </a>
                                                <a href="{{ asset('documentos/Guia_del_alumno_de_intercambio.pdf') }}" target="_blank" rel="noopener noreferrer" class="group/item flex items-center justify-between px-3 py-2 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                                    <span class="flex items-center gap-1.5 font-medium text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">
                                                        <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Foreign Student Handbook' : 'Guía del estudiante extranjero' }}</span>
                                                        <span class="text-[9px] font-bold text-red-600 bg-red-50 dark:bg-red-950 px-1 py-0.2 rounded">PDF</span>
                                                    </span>
                                                    <svg class="w-3 h-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                                </a>
                                                <a href="{{ route('mobility.delegations') }}" class="group/item flex items-center justify-between px-3 py-2 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                                    <span class="font-medium text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Delegations Visits' : 'Visita de delegaciones' }}</span>
                                                    <svg class="w-3 h-3 opacity-0 group-hover/item:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                </a>

                                                <!-- Módulos / Enlaces Adicionales Dinámicos para Movilidad Entrante creados en la Intranet -->
                                                @if(isset($navCustomPages) && $navCustomPages->has('movilidad_entrante'))
                                                    <div class="pt-1 mt-1 border-t border-[var(--border-color)]">
                                                        @foreach($navCustomPages->get('movilidad_entrante') as $dynPage)
                                                            <a href="{{ $dynPage->url }}" target="{{ $dynPage->target }}" class="group/item flex items-center justify-between px-3 py-1.5 rounded-lg text-xs text-emerald-800 dark:text-emerald-300 hover:bg-emerald-50 dark:hover:bg-emerald-950 transition-all">
                                                                <span class="truncate max-w-[210px]">{{ $dynPage->getTranslated('title') }}</span>
                                                                @if($dynPage->badge)
                                                                    <span class="text-[9px] font-bold px-1 py-0.2 rounded bg-emerald-100 text-[#0F5132]">{{ $dynPage->getTranslated('badge') }}</span>
                                                                @else
                                                                    <svg class="w-3 h-3 opacity-0 group-hover/item:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                                @endif
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- NIVEL 2: Movilidad Saliente (Outcoming) con Submenú Flyout a la derecha -->
                                    <div class="relative group/subsaliente">
                                        <div class="flex items-center justify-between px-3 py-2.5 rounded-lg text-xs font-semibold text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white cursor-pointer transition-all">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Outgoing Mobility (Outcoming)' : 'Movilidad Saliente (Outcoming)' }}</span>
                                            </div>
                                            <svg class="w-3.5 h-3.5 text-gray-400 group-hover/subsaliente:text-[#0F5132] dark:group-hover/subsaliente:text-white group-hover/subsaliente:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </div>

                                        <!-- Submenú Nivel 3 Flyout Derecha -->
                                        <div class="absolute left-full top-0 ml-1.5 opacity-0 -translate-x-2 invisible group-hover/subsaliente:opacity-100 group-hover/subsaliente:translate-x-0 group-hover/subsaliente:visible transition-all duration-200 w-80 z-50">
                                            <div class="bg-[var(--bg-surface)] rounded-xl shadow-2xl border border-[var(--border-color)] p-2 space-y-1">
                                                <a href="{{ route('mobility.outgoing') }}" class="group/item flex items-center justify-between px-3 py-2 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                                    <span class="font-medium text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Study Abroad' : 'Estudia en el extranjero' }}</span>
                                                    <svg class="w-3 h-3 opacity-0 group-hover/item:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                </a>
                                                <a href="{{ route('mobility.excellence') }}" class="group/item flex items-center justify-between px-3 py-2 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                                    <span class="font-medium text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Academic Excellence - BEAI' : 'Excelencia Académica Internacional - BEAI' }}</span>
                                                    <svg class="w-3 h-3 opacity-0 group-hover/item:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                </a>
                                                <a href="{{ route('mobility.pacific_alliance') }}" class="group/item flex items-center justify-between px-3 py-2 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                                    <span class="font-medium text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Pacific Alliance Scholarship' : 'Beca Alianza del Pacífico' }}</span>
                                                    <svg class="w-3 h-3 opacity-0 group-hover/item:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                </a>

                                                <!-- Módulos / Enlaces Adicionales Dinámicos para Movilidad Saliente creados en la Intranet -->
                                                @if(isset($navCustomPages) && $navCustomPages->has('movilidad_saliente'))
                                                    <div class="pt-1 mt-1 border-t border-[var(--border-color)]">
                                                        @foreach($navCustomPages->get('movilidad_saliente') as $dynPage)
                                                            <a href="{{ $dynPage->url }}" target="{{ $dynPage->target }}" class="group/item flex items-center justify-between px-3 py-1.5 rounded-lg text-xs text-emerald-800 dark:text-emerald-300 hover:bg-emerald-50 dark:hover:bg-emerald-950 transition-all">
                                                                <span class="truncate max-w-[210px]">{{ $dynPage->getTranslated('title') }}</span>
                                                                @if($dynPage->badge)
                                                                    <span class="text-[9px] font-bold px-1 py-0.2 rounded bg-emerald-100 text-[#0F5132]">{{ $dynPage->getTranslated('badge') }}</span>
                                                                @else
                                                                    <svg class="w-3 h-3 opacity-0 group-hover/item:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                                @endif
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- NIVEL 2: Summer Camp -->
                                    <a href="{{ route('mobility.summer_camp') }}" class="group/item flex items-center justify-between px-3 py-2.5 rounded-lg text-xs font-semibold text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-amber-600 dark:text-amber-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <span class="font-medium text-[var(--text-primary)] group-hover/item:text-[#0F5132] dark:group-hover/item:text-white">Summer Camp</span>
                                        </div>
                                        <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300">UNALM</span>
                                    </a>

                                    <!-- Módulos / Enlaces Adicionales Dinámicos para Summer Camp o Movilidad General creados en la Intranet -->
                                    @if(isset($navCustomPages) && ($navCustomPages->has('summer_camp') || $navCustomPages->has('movilidad_general') || $navCustomPages->has('movilidad')))
                                        <div class="pt-1 mt-1 border-t border-[var(--border-color)]">
                                            @foreach(['summer_camp', 'movilidad_general', 'movilidad'] as $mSec)
                                                @if($navCustomPages->has($mSec))
                                                    @foreach($navCustomPages->get($mSec) as $dynPage)
                                                        <a href="{{ $dynPage->url }}" target="{{ $dynPage->target }}" class="group/item flex items-center justify-between px-3 py-1.5 rounded-lg text-xs text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-700/80 hover:text-[#0F5132] dark:hover:text-white transition-all">
                                                            <span class="truncate max-w-[210px]">{{ $dynPage->getTranslated('title') }}</span>
                                                            @if($dynPage->badge)
                                                                <span class="text-[9px] font-bold px-1 py-0.2 rounded bg-emerald-100 text-[#0F5132]">{{ $dynPage->getTranslated('badge') }}</span>
                                                            @endif
                                                        </a>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <a href="{{ route('calls.index') }}" class="nav-link-btn px-3 py-2 rounded-md whitespace-nowrap transition-colors {{ request()->routeIs('calls.*') ? 'nav-link-active text-[#0F5132] dark:text-emerald-400 font-bold border-b-2 border-[#0F5132] dark:border-emerald-400 rounded-none' : 'text-[var(--text-secondary)] hover:text-[#0F5132] dark:hover:text-emerald-400' }}">
                            {{ ($currentLocale ?? 'es') === 'en' ? 'Calls & Grants' : 'Becas y Convocatorias' }}
                        </a>

                        <a href="{{ route('news.index') }}" class="nav-link-btn px-3 py-2 rounded-md whitespace-nowrap transition-colors {{ request()->routeIs('news.*') ? 'nav-link-active text-[#0F5132] dark:text-emerald-400 font-bold border-b-2 border-[#0F5132] dark:border-emerald-400 rounded-none' : 'text-[var(--text-secondary)] hover:text-[#0F5132] dark:hover:text-emerald-400' }}">
                            {{ ($currentLocale ?? 'es') === 'en' ? 'News & Events' : 'Noticias' }}
                        </a>

                        <a href="{{ route('resources.index') }}" class="nav-link-btn px-3 py-2 rounded-md whitespace-nowrap transition-colors {{ request()->routeIs('resources.*') ? 'nav-link-active text-[#0F5132] dark:text-emerald-400 font-bold border-b-2 border-[#0F5132] dark:border-emerald-400 rounded-none' : 'text-[var(--text-secondary)] hover:text-[#0F5132] dark:hover:text-emerald-400' }}">
                            {{ ($currentLocale ?? 'es') === 'en' ? 'Documents' : 'Recursos' }}
                        </a>

                        <a href="{{ route('contact') }}" class="nav-link-btn px-3 py-2 rounded-md whitespace-nowrap transition-colors {{ request()->routeIs('contact') ? 'nav-link-active text-[#0F5132] dark:text-emerald-400 font-bold border-b-2 border-[#0F5132] dark:border-emerald-400 rounded-none' : 'text-[var(--text-secondary)] hover:text-[#0F5132] dark:hover:text-emerald-400' }}">
                            {{ ($currentLocale ?? 'es') === 'en' ? 'Contact' : 'Contacto' }}
                        </a>
                    </nav>

                    <!-- Utilidades: Idioma ES/EN, Modo Oscuro y Menú Móvil -->
                    <div class="flex items-center gap-2 sm:gap-3">
                        <!-- Selector de Idioma -->
                        <div class="header-util-btn flex items-center border border-[var(--border-color)] rounded-lg overflow-hidden text-xs font-bold shadow-sm">
                            <a href="{{ route('locale.switch', 'es') }}" class="header-lang-btn px-2.5 py-1.5 transition-colors {{ ($currentLocale ?? 'es') === 'es' ? 'bg-[#0F5132] text-white' : 'text-[var(--text-muted)] hover:bg-gray-100 dark:hover:bg-gray-800' }}" title="Versión en Español">
                                ES
                            </a>
                            <a href="{{ route('locale.switch', 'en') }}" class="header-lang-btn px-2.5 py-1.5 transition-colors {{ ($currentLocale ?? 'es') === 'en' ? 'bg-[#0F5132] text-white' : 'text-[var(--text-muted)] hover:bg-gray-100 dark:hover:bg-gray-800' }}" title="English Version">
                                EN
                            </a>
                        </div>

                        <!-- Botón Modo Oscuro / Claro -->
                        <button type="button" class="theme-toggle header-util-btn p-2 rounded-lg border border-[var(--border-color)] text-[var(--text-secondary)] hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors shadow-sm" aria-label="{{ ($currentLocale ?? 'es') === 'en' ? 'Toggle Dark / Light Mode' : 'Cambiar tema de color (Modo Oscuro / Claro)' }}" title="{{ ($currentLocale ?? 'es') === 'en' ? 'Toggle Dark / Light Mode' : 'Alternar Modo Oscuro / Claro' }}">
                            <!-- Icono Sol (se muestra en modo oscuro para volver a claro) -->
                            <svg class="w-4 h-4 theme-icon-sun text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <!-- Icono Luna (se muestra en modo claro para cambiar a oscuro) -->
                            <svg class="w-4 h-4 theme-icon-moon text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        </button>

                        <!-- Botón Menú Móvil -->
                        <button type="button" id="mobile-menu-toggle" class="header-util-btn lg:hidden p-2 rounded-lg border border-[var(--border-color)] text-[var(--text-secondary)] hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-expanded="false" aria-controls="mobile-menu-drawer" aria-label="{{ ($currentLocale ?? 'es') === 'en' ? 'Open navigation menu' : 'Abrir menú de navegación' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <!-- Menú Móvil Desplegable (Drawer Accesible) -->
    <div id="mobile-menu-backdrop" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden transition-opacity lg:hidden" aria-hidden="true"></div>
    <div id="mobile-menu-drawer" class="fixed inset-y-0 right-0 max-w-xs w-full bg-[var(--bg-surface)] shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out p-6 flex flex-col justify-between overflow-y-auto lg:hidden" role="dialog" aria-modal="true" aria-label="{{ ($currentLocale ?? 'es') === 'en' ? 'Main mobile menu' : 'Menú principal móvil' }}">
        <div>
            <div class="flex items-center justify-between pb-4 border-b border-[var(--border-color)]">
                <span class="font-bold text-[#0F5132] dark:text-emerald-400">{{ ($currentLocale ?? 'es') === 'en' ? 'OGI Navigation' : 'Navegación OGI' }}</span>
                <button type="button" id="mobile-menu-close" class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800" aria-label="{{ ($currentLocale ?? 'es') === 'en' ? 'Close menu' : 'Cerrar menú' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Selector de Idioma y Modo Oscuro en Móvil -->
            <div class="flex items-center justify-between py-3 border-b border-[var(--border-color)]">
                <div class="flex items-center border border-[var(--border-color)] rounded-lg overflow-hidden text-xs font-bold shadow-sm">
                    <a href="{{ route('locale.switch', 'es') }}" class="px-3 py-1.5 transition-colors {{ ($currentLocale ?? 'es') === 'es' ? 'bg-[#0F5132] text-white' : 'text-[var(--text-muted)] hover:bg-gray-100 dark:hover:bg-gray-800' }}">ES</a>
                    <a href="{{ route('locale.switch', 'en') }}" class="px-3 py-1.5 transition-colors {{ ($currentLocale ?? 'es') === 'en' ? 'bg-[#0F5132] text-white' : 'text-[var(--text-muted)] hover:bg-gray-100 dark:hover:bg-gray-800' }}">EN</a>
                </div>
                <button type="button" class="theme-toggle p-2 rounded-lg border border-[var(--border-color)] text-[var(--text-secondary)] hover:bg-gray-100 dark:hover:bg-gray-800 shadow-sm" aria-label="Modo Oscuro / Claro">
                    <svg class="w-4 h-4 theme-icon-sun text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <svg class="w-4 h-4 theme-icon-moon text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>
            </div>

            <nav class="mt-4 space-y-2 text-sm font-medium">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-primary)] {{ request()->routeIs('home') ? 'font-bold text-[#0F5132] dark:text-emerald-400' : '' }}">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Home' : 'Inicio' }}
                </a>
                
                <div class="pt-2 pb-1 border-t border-[var(--border-color)]">
                    <span class="px-3 text-xs uppercase tracking-wider text-[var(--text-muted)] font-semibold">{{ ($currentLocale ?? 'es') === 'en' ? 'About OGI' : 'La OGI' }}</span>
                    <a href="{{ route('ogi.presentation') }}" class="block px-3 py-1.5 rounded-md hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-secondary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Presentation' : 'Presentación' }}</a>
                    <a href="{{ route('ogi.mission_vision') }}" class="block px-3 py-1.5 rounded-md hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-secondary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Mission & Vision' : 'Misión, Visión y Valores' }}</a>
                    <a href="{{ route('ogi.team') }}" class="block px-3 py-1.5 rounded-md hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-secondary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Management Team' : 'Equipo de Gestión' }}</a>
                </div>

                <div class="pt-2 pb-1 border-t border-[var(--border-color)]">
                    <span class="px-3 text-xs uppercase tracking-wider text-[var(--text-muted)] font-semibold">{{ ($currentLocale ?? 'es') === 'en' ? 'Agreements & Networks' : 'Convenios y Redes' }}</span>
                    <a href="{{ route('agreements.international') }}" class="block px-3 py-1.5 rounded-md hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-secondary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'International Agreements' : 'Convenios Internacionales' }}</a>
                    <a href="{{ route('agreements.national') }}" class="block px-3 py-1.5 rounded-md hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-secondary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'National Agreements' : 'Convenios Nacionales' }}</a>
                    <a href="{{ route('agreements.networks') }}" class="block px-3 py-1.5 rounded-md hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-secondary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Networks & Allies' : 'Redes y Aliados' }}</a>
                    
                    @if(isset($navCustomPages) && $navCustomPages->isNotEmpty())
                        @foreach($navCustomPages as $secKey => $pagesGroup)
                            @php
                                $secTitle = ($currentLocale ?? 'es') === 'en' 
                                    ? (\App\Models\CustomPage::$navSectionsEn[$secKey] ?? ucfirst(str_replace('_', ' ', $secKey)))
                                    : (\App\Models\CustomPage::$navSections[$secKey] ?? ucfirst(str_replace('_', ' ', $secKey)));
                            @endphp
                            <div class="pl-3 pt-2">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 block mb-0.5">{{ $secTitle }}</span>
                                @foreach($pagesGroup as $cp)
                                    <a href="{{ route('pages.show', $cp->slug) }}" class="block px-3 py-1 rounded-md text-xs hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-secondary)] flex items-center justify-between">
                                        <span>{{ $cp->getTranslated('title') }}</span>
                                        <span class="text-[10px] text-emerald-600">→</span>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="pt-2 pb-1 border-t border-[var(--border-color)]">
                    <span class="px-3 text-xs uppercase tracking-wider text-[var(--text-muted)] font-semibold">{{ ($currentLocale ?? 'es') === 'en' ? 'Academic Mobility' : 'Movilidad' }}</span>
                    
                    <!-- Entrante en Móvil -->
                    <div class="mt-1 pl-2">
                        <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 rounded block">
                            {{ ($currentLocale ?? 'es') === 'en' ? 'Incoming Mobility (Incoming)' : 'Movilidad Entrante (Incoming)' }}
                        </span>
                        <div class="space-y-0.5 pl-2 mt-1">
                            <a href="{{ route('mobility.incoming') }}" class="block px-2 py-1 rounded text-xs hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-secondary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Study at UNALM' : 'Estudia en la UNALM' }}</a>
                            <a href="{{ route('mobility.special_programs') }}" class="block px-2 py-1 rounded text-xs hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-secondary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Special Programs' : 'Programas especiales' }}</a>
                            <a href="{{ route('mobility.testimonies') }}" class="block px-2 py-1 rounded text-xs hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-secondary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Student Testimonials' : 'Testimonio de los alumnos extranjeros' }}</a>
                            <a href="{{ asset('documentos/Guia_del_alumno_de_intercambio.pdf') }}" target="_blank" rel="noopener noreferrer" class="block px-2 py-1 rounded text-xs hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-red-600 dark:text-red-400 font-semibold flex items-center justify-between">
                                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Student Handbook (PDF)' : 'Guía del estudiante extranjero' }}</span>
                                <span class="text-[9px] bg-red-100 text-red-700 px-1 rounded">PDF</span>
                            </a>
                            <a href="{{ route('mobility.delegations') }}" class="block px-2 py-1 rounded text-xs hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-secondary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Delegations Visits' : 'Visita de delegaciones' }}</a>
                            @if(isset($navCustomPages) && $navCustomPages->has('movilidad_entrante'))
                                @foreach($navCustomPages->get('movilidad_entrante') as $dynPage)
                                    <a href="{{ $dynPage->url }}" target="{{ $dynPage->target }}" class="block px-2 py-1 rounded text-xs text-emerald-800 dark:text-emerald-300">{{ $dynPage->getTranslated('title') }}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Saliente en Móvil -->
                    <div class="mt-2 pl-2">
                        <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 rounded block">
                            {{ ($currentLocale ?? 'es') === 'en' ? 'Outgoing Mobility (Outcoming)' : 'Movilidad Saliente (Outcoming)' }}
                        </span>
                        <div class="space-y-0.5 pl-2 mt-1">
                            <a href="{{ route('mobility.outgoing') }}" class="block px-2 py-1 rounded text-xs hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-secondary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Study Abroad' : 'Estudia en el extranjero' }}</a>
                            <a href="{{ route('mobility.excellence') }}" class="block px-2 py-1 rounded text-xs hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-secondary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Academic Excellence - BEAI' : 'Excelencia Académica Internacional - BEAI' }}</a>
                            <a href="{{ route('mobility.pacific_alliance') }}" class="block px-2 py-1 rounded text-xs hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-secondary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Pacific Alliance Scholarship' : 'Beca Alianza del Pacífico' }}</a>
                            @if(isset($navCustomPages) && $navCustomPages->has('movilidad_saliente'))
                                @foreach($navCustomPages->get('movilidad_saliente') as $dynPage)
                                    <a href="{{ $dynPage->url }}" target="{{ $dynPage->target }}" class="block px-2 py-1 rounded text-xs text-emerald-800 dark:text-emerald-300">{{ $dynPage->getTranslated('title') }}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Summer Camp en Móvil -->
                    <div class="mt-2 pl-2">
                        <a href="{{ route('mobility.summer_camp') }}" class="block px-2 py-1 rounded text-xs font-bold text-amber-700 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-950/40">
                            Summer Camp UNALM
                        </a>
                    </div>
                </div>

                <a href="{{ route('calls.index') }}" class="block px-3 py-2 rounded-md hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-primary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Calls & Grants' : 'Becas y Convocatorias' }}</a>
                <a href="{{ route('news.index') }}" class="block px-3 py-2 rounded-md hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-primary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'News & Events' : 'Noticias y Eventos' }}</a>
                <a href="{{ route('resources.index') }}" class="block px-3 py-2 rounded-md hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-primary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Documents' : 'Recursos y Documentos' }}</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md hover:bg-emerald-50 dark:hover:bg-emerald-950/50 text-[var(--text-primary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Contact' : 'Contacto' }}</a>
            </nav>
        </div>

        <div class="pt-4 border-t border-[var(--border-color)]">
            <a href="{{ route('admin.login') }}" class="w-full btn-molinero text-center">
                {{ ($currentLocale ?? 'es') === 'en' ? 'CMS Intranet Access' : 'Acceso a Intranet CMS' }}
            </a>
        </div>
    </div>

    <!-- Contenido Principal Dinámico -->
    <main id="contenido-principal" class="flex-grow">
        @yield('content')
    </main>

    <!-- Pie de Página Institucional -->
    <footer class="bg-[#0A3622] text-white pt-12 pb-8 border-t border-emerald-900 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 pb-10 border-b border-emerald-900/60">
                <!-- Columna 1: Identidad -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('imagenes/logo_footer.png') }}" alt="Escudo UNALM" class="h-11 w-auto object-contain" />
                        <div>
                            <span class="block font-bold text-white leading-tight">UNALM</span>
                            <span class="block text-xs text-emerald-300">{{ ($currentLocale ?? 'es') === 'en' ? 'Office of Inter-institutional Management and Global Affairs' : 'Oficina de Gestión Interinstitucional' }}</span>
                        </div>
                    </div>
                    <p class="text-xs text-emerald-200/80 leading-relaxed">
                        {{ ($currentLocale ?? 'es') === 'en' ? 'Governing body for internationalization, academic agreements, scholarships, and global cooperation at Universidad Nacional Agraria La Molina.' : 'Órgano rector de la internacionalización, convenios académicos, becas y cooperación global de la Universidad Nacional Agraria La Molina.' }}
                    </p>
                    <div class="flex items-center gap-2 text-xs text-emerald-300">
                        <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Public University Licensed by SUNEDU' : 'Universidad Pública Licenciada por SUNEDU' }}</span>
                    </div>
                </div>

                <!-- Columna 2: Enlaces Rápidos -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-b border-emerald-800 pb-2">
                        {{ ($currentLocale ?? 'es') === 'en' ? 'Quick Links' : 'Accesos Directos' }}
                    </h3>
                    <ul class="space-y-2 text-xs text-emerald-200">
                        <li><a href="{{ route('agreements.international') }}" class="hover:text-white transition-colors">{{ ($currentLocale ?? 'es') === 'en' ? 'International Agreements Directory' : 'Directorio de Convenios Internacionales' }}</a></li>
                        <li><a href="{{ route('agreements.national') }}" class="hover:text-white transition-colors">{{ ($currentLocale ?? 'es') === 'en' ? 'National & Inter-institutional Agreements' : 'Convenios Nacionales e Interinstitucionales' }}</a></li>
                        <li><a href="{{ route('mobility.outgoing') }}" class="hover:text-white transition-colors">{{ ($currentLocale ?? 'es') === 'en' ? 'Outgoing Mobility Guide' : 'Guía de Movilidad Saliente' }}</a></li>
                        <li><a href="{{ route('mobility.incoming') }}" class="hover:text-white transition-colors">{{ ($currentLocale ?? 'es') === 'en' ? 'Study at UNALM (International Students)' : 'International Students (Study at UNALM)' }}</a></li>
                        <li><a href="{{ route('calls.index') }}" class="hover:text-white transition-colors">{{ ($currentLocale ?? 'es') === 'en' ? 'Pacific Alliance & BEAI Scholarships' : 'Becas Alianza del Pacífico y BEAI' }}</a></li>
                    </ul>
                </div>

                <!-- Columna 3: Documentos y Transparencia -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-b border-emerald-800 pb-2">
                        {{ ($currentLocale ?? 'es') === 'en' ? 'Resources & Policies' : 'Recursos y Normativa' }}
                    </h3>
                    <ul class="space-y-2 text-xs text-emerald-200">
                        <li><a href="{{ route('resources.index') }}" class="hover:text-white transition-colors">{{ ($currentLocale ?? 'es') === 'en' ? 'Academic Mobility Regulations' : 'Reglamento de Movilidad Académica' }}</a></li>
                        <li><a href="{{ asset('documentos/Guia_del_alumno_de_intercambio.pdf') }}" target="_blank" class="hover:text-white transition-colors">{{ ($currentLocale ?? 'es') === 'en' ? 'Exchange Student Handbook (PDF)' : 'Guía del Alumno de Intercambio (PDF)' }}</a></li>
                        <li><a href="{{ asset('documentos/Convenios_Internacionales_Consolidado.pdf') }}" target="_blank" class="hover:text-white transition-colors">{{ ($currentLocale ?? 'es') === 'en' ? 'Official Consolidated Agreements Directory' : 'Consolidado Oficial de Convenios' }}</a></li>
                        <li><a href="https://vri.lamolina.edu.pe/" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors">{{ ($currentLocale ?? 'es') === 'en' ? 'Vice-Rectorate for Research (VRI)' : 'Vicerrectorado de Investigación (VRI)' }}</a></li>
                        <li><a href="https://www.lamolina.edu.pe/Rectorado/secgeneral/convenios_INTERNACIONALES.htm" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors">{{ ($currentLocale ?? 'es') === 'en' ? 'UNALM General Secretariat Agreements' : 'Convenios Secretaría General UNALM' }}</a></li>
                    </ul>
                </div>

                <!-- Columna 4: Contacto y Ubicación -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-b border-emerald-800 pb-2">
                        {{ ($currentLocale ?? 'es') === 'en' ? 'Official Contact' : 'Contacto Oficial' }}
                    </h3>
                    <ul class="space-y-2.5 text-xs text-emerald-200">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-emerald-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{!! ($currentLocale ?? 'es') === 'en' ? 'Av. La Molina s/n, La Molina — Lima, Peru<br>(Rectorate Building, 2nd Floor)' : 'Av. La Molina s/n, La Molina — Lima, Perú<br>(Edificio del Rectorado, 2.° Piso)' !!}</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <a href="mailto:ogi@lamolina.edu.pe" class="hover:text-white transition-colors">ogi@lamolina.edu.pe</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>{{ ($currentLocale ?? 'es') === 'en' ? '+51 1 614-7800 Ext. 212 / 215 / 218' : '(01) 614-7800 Anexos 212 / 215 / 218' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Créditos y Copyright -->
            <div class="mt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-emerald-300/70 gap-4">
                <p>&copy; {{ date('Y') }} Universidad Nacional Agraria La Molina — {{ ($currentLocale ?? 'es') === 'en' ? 'Office of Inter-institutional Management and Global Affairs (OGI). All rights reserved.' : 'Oficina de Gestión Interinstitucional y Asuntos Globales (OGI). Todos los derechos reservados.' }}</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.login') }}" class="hover:text-emerald-200">{{ ($currentLocale ?? 'es') === 'en' ? 'Intranet Access' : 'Acceso Intranet' }}</a>
                    <span>•</span>
                    <a href="{{ route('contact') }}" class="hover:text-emerald-200">{{ ($currentLocale ?? 'es') === 'en' ? 'Privacy Policy' : 'Aviso de Privacidad' }}</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

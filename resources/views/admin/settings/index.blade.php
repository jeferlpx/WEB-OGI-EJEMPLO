@extends('layouts.admin')

@section('title', 'Ajustes y Contenidos Institucionales')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Administración de Contenidos y Configuración</h1>
            <p class="text-xs text-[var(--text-muted)]">Modifique en tiempo real textos institucionales, portadas, mensajes de dirección, marcos estratégicos y contactos sin tocar código.</p>
        </div>

        <a href="{{ route('home') }}" target="_blank" class="btn-molinero-outline text-xs py-2 px-3 flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            <span>Ver Portal Público</span>
        </a>
    </div>

    @if(session('success'))
    <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-300 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-xs font-semibold flex items-center gap-2 shadow-sm">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- 1. MULTIMEDIA Y PORTADA HERO -->
        <div class="card-molinero p-6 space-y-5 border-2 border-emerald-700/30">
            <div class="flex items-center justify-between border-b border-[var(--border-color)] pb-3">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-emerald-600 animate-pulse"></span>
                    <h2 class="text-sm font-bold text-[var(--text-primary)]">1. Fondo Multimedia de Portada (Hero)</h2>
                </div>
                <span class="text-[11px] text-emerald-700 dark:text-emerald-400 font-semibold bg-emerald-50 dark:bg-emerald-950/60 px-2.5 py-1 rounded-full border border-emerald-300 dark:border-emerald-800">
                    Control Visual
                </span>
            </div>

            <!-- 1.1 MODO DE SUPERPOSICIÓN DEL MENÚ SOBRE EL BANNER (HEADER OVERLAY) -->
            <div class="p-4 rounded-xl bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-300 dark:border-emerald-800/60 space-y-3">
                <div class="flex items-center justify-between">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-primary)]">
                            Modo de Visualización del Menú Superior y Banner
                        </label>
                        <p class="text-[11px] text-[var(--text-muted)]">
                            Elija si el banner cubre toda la pantalla pasando detrás del menú de navegación, o si se mantiene separado.
                        </p>
                    </div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-300 bg-emerald-100 dark:bg-emerald-900/60 px-2.5 py-0.5 rounded-full">
                        Diseño Institucional
                    </span>
                </div>

                @php $currentOverlay = \App\Models\SiteSetting::get('hero_header_overlay', 'overlay'); @endphp
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                    <!-- Opción 1: Con Superposición (Inmersivo) -->
                    <label class="radio-card relative flex flex-col p-4 rounded-xl border-2 cursor-pointer transition-all {{ ($currentOverlay === 'overlay' || $currentOverlay === '1') ? 'border-[#0F5132] bg-white dark:bg-[#121F19] ring-2 ring-[#0F5132] shadow-md' : 'border-[var(--border-color)] bg-[var(--bg-surface)] hover:border-gray-400' }}">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-[var(--text-primary)] flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Con Superposición (Banner Abarca Todo)
                            </span>
                            <span class="text-[9px] font-extrabold uppercase px-2 py-0.5 rounded bg-emerald-100 dark:bg-emerald-900/80 text-emerald-800 dark:text-emerald-200">
                                Recomendado (Estilo VRI UNALM / Centrum)
                            </span>
                        </div>
                        <input type="radio" name="hero_header_overlay" value="overlay" class="sr-only" {{ ($currentOverlay === 'overlay' || $currentOverlay === '1') ? 'checked' : '' }}>
                        <p class="text-[11px] text-[var(--text-secondary)] leading-relaxed">
                            El banner o video cubre desde el borde superior de la pantalla. El menú flota de forma <strong>transparente</strong> sobre la portada; y al hacer scroll hacia abajo, se convierte suavemente en una barra sólida fija con blur y sombra.
                        </p>
                        <!-- Miniatura ilustrativa -->
                        <div class="mt-3 rounded-lg overflow-hidden border border-emerald-300/60 bg-emerald-950 p-2 text-white">
                            <div class="flex items-center justify-between border-b border-white/20 pb-1 text-[9px] text-white/80">
                                <span class="font-bold text-white">OGI — UNALM</span>
                                <span>Inicio • La OGI • Convenios</span>
                            </div>
                            <div class="py-2.5 text-center text-[10px] font-semibold text-emerald-200">
                                [ Banner o Video de Fondo Inmersivo ]
                            </div>
                        </div>
                    </label>

                    <!-- Opción 2: Sin Superposición (Estándar) -->
                    <label class="radio-card relative flex flex-col p-4 rounded-xl border-2 cursor-pointer transition-all {{ ($currentOverlay === 'standard' || $currentOverlay === '0') ? 'border-[#0F5132] bg-white dark:bg-[#121F19] ring-2 ring-[#0F5132] shadow-md' : 'border-[var(--border-color)] bg-[var(--bg-surface)] hover:border-gray-400' }}">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-[var(--text-primary)] flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-gray-400"></span>
                                Sin Superposición (Menú Separado)
                            </span>
                            <span class="text-[9px] font-extrabold uppercase px-2 py-0.5 rounded bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                                Estilo Estándar
                            </span>
                        </div>
                        <input type="radio" name="hero_header_overlay" value="standard" class="sr-only" {{ ($currentOverlay === 'standard' || $currentOverlay === '0') ? 'checked' : '' }}>
                        <p class="text-[11px] text-[var(--text-secondary)] leading-relaxed">
                            El menú superior conserva su barra blanca/sólida en todo momento con borde inferior visible, y el banner de portada comienza debajo de él de manera tradicional.
                        </p>
                        <!-- Miniatura ilustrativa -->
                        <div class="mt-3 rounded-lg overflow-hidden border border-gray-300 bg-gray-100 dark:bg-gray-800 p-2">
                            <div class="flex items-center justify-between bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 px-2 py-1 rounded text-[9px] text-[var(--text-primary)]">
                                <span class="font-bold text-[#0F5132]">OGI — UNALM</span>
                                <span>Inicio • La OGI • Convenios</span>
                            </div>
                            <div class="mt-1 bg-emerald-900 text-white py-1.5 text-center text-[10px] font-semibold rounded">
                                [ Banner Debajo del Menú ]
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- 1.2 TIPO DE FONDO MULTIMEDIA -->
            <div class="pt-2 border-t border-[var(--border-color)]">
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-2">Seleccione el Tipo de Fondo para la Portada:</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
                    @php $currentMediaType = \App\Models\SiteSetting::get('hero_media_type', 'image'); @endphp
                    
                    <label class="radio-card relative flex flex-col p-3 rounded-xl border cursor-pointer transition-all {{ $currentMediaType === 'image' ? 'border-[#0F5132] bg-emerald-50/60 dark:bg-emerald-950/40 ring-2 ring-[#0F5132]' : 'border-[var(--border-color)] hover:bg-gray-50 dark:hover:bg-gray-800/50' }}">
                        <input type="radio" name="hero_media_type" value="image" class="sr-only" {{ $currentMediaType === 'image' ? 'checked' : '' }}>
                        <span class="text-xs font-bold text-[var(--text-primary)] flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Foto Fija
                        </span>
                        <span class="text-[10px] text-[var(--text-muted)] mt-1">Imagen destacada única con velo</span>
                    </label>

                    <label class="radio-card relative flex flex-col p-3 rounded-xl border cursor-pointer transition-all {{ $currentMediaType === 'carousel' ? 'border-[#0F5132] bg-emerald-50/60 dark:bg-emerald-950/40 ring-2 ring-[#0F5132]' : 'border-[var(--border-color)] hover:bg-gray-50 dark:hover:bg-gray-800/50' }}">
                        <input type="radio" name="hero_media_type" value="carousel" class="sr-only" {{ $currentMediaType === 'carousel' ? 'checked' : '' }}>
                        <span class="text-xs font-bold text-[var(--text-primary)] flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                            Carrusel Animado
                        </span>
                        <span class="text-[10px] text-[var(--text-muted)] mt-1">Rotación automática de fotos</span>
                    </label>

                    <label class="radio-card relative flex flex-col p-3 rounded-xl border cursor-pointer transition-all {{ $currentMediaType === 'video' ? 'border-[#0F5132] bg-emerald-50/60 dark:bg-emerald-950/40 ring-2 ring-[#0F5132]' : 'border-[var(--border-color)] hover:bg-gray-50 dark:hover:bg-gray-800/50' }}">
                        <input type="radio" name="hero_media_type" value="video" class="sr-only" {{ $currentMediaType === 'video' ? 'checked' : '' }}>
                        <span class="text-xs font-bold text-[var(--text-primary)] flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            Video Local (.mp4)
                        </span>
                        <span class="text-[10px] text-[var(--text-muted)] mt-1">Bucle continuo y silencioso</span>
                    </label>

                    <label class="radio-card relative flex flex-col p-3 rounded-xl border cursor-pointer transition-all {{ $currentMediaType === 'youtube' ? 'border-[#0F5132] bg-emerald-50/60 dark:bg-emerald-950/40 ring-2 ring-[#0F5132]' : 'border-[var(--border-color)] hover:bg-gray-50 dark:hover:bg-gray-800/50' }}">
                        <input type="radio" name="hero_media_type" value="youtube" class="sr-only" {{ $currentMediaType === 'youtube' ? 'checked' : '' }}>
                        <span class="text-xs font-bold text-[var(--text-primary)] flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            Video YouTube
                        </span>
                        <span class="text-[10px] text-[var(--text-muted)] mt-1">Enlace o ID de video oficial</span>
                    </label>

                    <label class="radio-card relative flex flex-col p-3 rounded-xl border cursor-pointer transition-all {{ $currentMediaType === 'gradient' ? 'border-[#0F5132] bg-emerald-50/60 dark:bg-emerald-950/40 ring-2 ring-[#0F5132]' : 'border-[var(--border-color)] hover:bg-gray-50 dark:hover:bg-gray-800/50' }}">
                        <input type="radio" name="hero_media_type" value="gradient" class="sr-only" {{ $currentMediaType === 'gradient' ? 'checked' : '' }}>
                        <span class="text-xs font-bold text-[var(--text-primary)] flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-gray-500"></span>
                            Degradado Molinero
                        </span>
                        <span class="text-[10px] text-[var(--text-muted)] mt-1">Verde sobrio sin imagen</span>
                    </label>
                </div>
            </div>

            <!-- Panel de Fotografías de Portada y Carrusel (Gestor de Contenidos de Fotos) -->
            <div id="media-panel-image" class="space-y-5 pt-3 border-t border-[var(--border-color)] {{ ($currentMediaType === 'image' || $currentMediaType === 'carousel') ? '' : 'hidden' }}">
                
                <!-- Notificaciones de Modo -->
                <div id="carousel-mode-notice" class="p-3.5 rounded-xl bg-amber-50 dark:bg-amber-950/30 border border-amber-300 dark:border-amber-800 text-amber-900 dark:text-amber-200 text-xs flex items-center gap-2.5 {{ $currentMediaType === 'carousel' ? '' : 'hidden' }}">
                    <span class="text-base">🎠</span>
                    <div>
                        <strong class="font-bold">Modo Carrusel de Fotos Activo:</strong>
                        <span>Las fotos que tengan activada la casilla <strong class="text-emerald-700 dark:text-emerald-300">[✓ En Carrusel]</strong> rotarán automáticamente cada 5.5 segundos en la portada del portal público. Puede subir fotos desde su PC y administrar cuáles rotan.</span>
                    </div>
                </div>

                <div id="image-mode-notice" class="p-3.5 rounded-xl bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-300 dark:border-emerald-800 text-emerald-900 dark:text-emerald-200 text-xs flex items-center gap-2.5 {{ $currentMediaType === 'image' ? '' : 'hidden' }}">
                    <span class="text-base">📷</span>
                    <div>
                        <strong class="font-bold">Modo Foto Fija Activo:</strong>
                        <span>La fotografía marcada con la estrella <strong class="text-amber-600 dark:text-amber-300">[⭐ Portada Principal]</strong> se mostrará fija de fondo en la portada del portal público.</span>
                    </div>
                </div>

                <!-- Subida Asíncrona de Fotos desde el PC al Catálogo del Sistema -->
                <div class="p-4 rounded-xl border-2 border-dashed border-emerald-400/80 dark:border-emerald-700/80 bg-emerald-50/20 dark:bg-emerald-950/20 space-y-3">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                        <div>
                            <span class="text-xs font-bold text-[#0F5132] dark:text-emerald-400 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Subir Nueva Foto desde la Computadora (JPG, PNG, WebP — Máx. 15MB)
                            </span>
                            <p class="text-[11px] text-[var(--text-secondary)]">
                                Se almacenará en el servidor y quedará pre-cargada permanentemente para usarla en el carrusel o como portada fija.
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full sm:w-auto">
                            <input type="text" id="ajax_banner_title_input" placeholder="Título opcional (ej: Ceremonia 2026)" class="text-xs px-3 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] w-full sm:w-56" />
                            <label for="ajax_banner_file_input" class="btn-molinero text-xs py-2 px-3.5 cursor-pointer hover:scale-105 transition-all shadow-sm flex-shrink-0 flex items-center justify-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                <span>Subir Foto a la Galería</span>
                            </label>
                            <input type="file" id="ajax_banner_file_input" accept="image/png,image/jpeg,image/webp" class="sr-only" onchange="uploadBannerAjax(this)" />
                        </div>
                    </div>

                    <!-- Barra de Progreso en Vivo para Banner -->
                    <div id="banner_upload_progress_container" class="hidden space-y-1.5 pt-2 border-t border-emerald-200 dark:border-emerald-800">
                        <div class="flex items-center justify-between text-[11px] font-semibold text-[#0F5132] dark:text-emerald-300">
                            <span id="banner_upload_status_text">Subiendo fotografía al servidor...</span>
                            <span id="banner_upload_percent">0%</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-emerald-200/60 dark:bg-emerald-950 overflow-hidden">
                            <div id="banner_upload_progress_bar" class="h-full bg-[#0F5132] dark:bg-emerald-400 rounded-full transition-all duration-150" style="width: 0%;"></div>
                        </div>
                    </div>

                    <!-- Mensaje de Resultado AJAX Banner -->
                    <div id="banner_ajax_alert" class="hidden p-3 rounded-lg text-xs font-medium"></div>
                </div>

                <!-- Catálogo Interactivo de Fotografías Oficiales Pre-cargadas -->
                <div class="space-y-3 pt-2">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-1">
                        <label class="block text-xs font-bold text-[var(--text-primary)] flex items-center gap-2">
                            <span>Fotografías Oficiales Pre-cargadas en el Sistema:</span>
                            <span class="text-[10px] font-semibold text-emerald-700 dark:text-emerald-300 bg-emerald-100 dark:bg-emerald-900/60 px-2 py-0.5 rounded-full">
                                {{ count($bannerImages ?? []) }} fotos disponibles
                            </span>
                        </label>
                        <span class="text-[10px] text-[var(--text-muted)]">
                            Haga clic en una tarjeta para fijarla como portada principal, o marque la casilla de carrusel.
                        </span>
                    </div>

                    <!-- Explicación Clara del Orden de Secuencia del Carrusel -->
                    <div class="p-3 rounded-xl bg-emerald-50/80 dark:bg-emerald-950/40 border border-emerald-300 dark:border-emerald-800 text-[11px] text-[var(--text-secondary)] flex items-start gap-2.5">
                        <span class="text-base flex-shrink-0 mt-0.5">ℹ️</span>
                        <div class="space-y-1">
                            <strong class="font-bold text-[#0F5132] dark:text-emerald-300 block">¿Cómo se define el orden de rotación en el Carrusel?</strong>
                            <p class="leading-relaxed">
                                Las fotos marcadas como <strong class="text-emerald-700 dark:text-emerald-300">[✓ En Carrusel]</strong> se reproducen secuencialmente de izquierda a derecha (Posición <strong>#1</strong> primero, luego <strong>#2</strong>, <strong>#3</strong>...). Use los botones <strong>◀</strong> y <strong>▶</strong> en cada tarjeta para mover cualquier foto antes o después en la rotación en tiempo real.
                            </p>
                        </div>
                    </div>

                    @php $currentImg = \App\Models\SiteSetting::get('hero_image_path', 'imagenes/portadas/portada1.png'); @endphp
                    <div id="banner-cards-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($bannerImages as $bImg)
                        @php 
                            $isFeatured = ($currentImg === $bImg->image_path || $bImg->is_featured);
                            $inCarousel = (bool)$bImg->is_active_carousel;
                        @endphp
                        <div id="banner-card-{{ $bImg->id }}" data-id="{{ $bImg->id }}" class="banner-photo-card p-3 rounded-xl border-2 {{ $isFeatured ? 'border-[#0F5132] bg-emerald-50/50 dark:bg-emerald-950/40 ring-2 ring-[#0F5132]' : 'border-[var(--border-color)] bg-[var(--bg-surface)]' }} flex flex-col justify-between transition-all space-y-3 shadow-sm hover:border-gray-400">
                            
                            <!-- Miniatura, Badges y Título -->
                            <div class="space-y-2">
                                <div class="relative h-28 w-full rounded-lg overflow-hidden border border-[var(--border-color)] bg-black/10">
                                    <img src="{{ asset($bImg->image_path) }}" alt="{{ $bImg->title }}" class="w-full h-full object-cover">
                                    
                                    <!-- Badge de Posición / Orden en la Secuencia -->
                                    <span class="order-badge absolute top-2 left-2 px-2 py-0.5 rounded-md bg-black/75 backdrop-blur-md text-white text-[10px] font-black shadow flex items-center gap-0.5 border border-white/20">
                                        <span class="text-[#D4AF37]">#</span><span class="order-num">{{ $loop->iteration }}</span>
                                    </span>

                                    <!-- Badge de Portada Principal Fija -->
                                    <span class="featured-badge absolute top-2 right-2 px-2 py-0.5 rounded-md bg-[#D4AF37] text-gray-950 text-[9px] font-extrabold shadow flex items-center gap-1 {{ $isFeatured ? '' : 'hidden' }}">
                                        ⭐ Portada Principal
                                    </span>
                                </div>

                                <div>
                                    <span class="block text-xs font-bold text-[var(--text-primary)] truncate" title="{{ $bImg->title }}">{{ $bImg->title }}</span>
                                    <span class="block text-[10px] text-[var(--text-muted)] font-mono truncate">{{ $bImg->image_path }}</span>
                                </div>

                                <!-- Selector / Flechas de Orden Secuencial -->
                                <div class="flex items-center justify-between p-1.5 rounded-lg bg-[var(--bg-page)] border border-[var(--border-color)] text-[11px]">
                                    <span class="text-[10px] font-bold text-[var(--text-secondary)] uppercase tracking-wider">Orden de Secuencia:</span>
                                    <div class="flex items-center gap-1">
                                        <button type="button" onclick="moveBannerOrderAjax({{ $bImg->id }}, 'up')" class="px-2 py-0.5 rounded bg-white dark:bg-gray-800 border border-[var(--border-color)] hover:border-emerald-500 hover:text-emerald-600 font-bold text-xs transition-colors shadow-xs" title="Mover antes en la secuencia del carrusel">
                                            ◀
                                        </button>
                                        <button type="button" onclick="moveBannerOrderAjax({{ $bImg->id }}, 'down')" class="px-2 py-0.5 rounded bg-white dark:bg-gray-800 border border-[var(--border-color)] hover:border-emerald-500 hover:text-emerald-600 font-bold text-xs transition-colors shadow-xs" title="Mover después en la secuencia del carrusel">
                                            ▶
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Barra de Acciones y Toggles -->
                            <div class="pt-2 border-t border-[var(--border-color)] flex items-center justify-between gap-1 text-[11px]">
                                <!-- Toggle Carrusel -->
                                <button type="button" onclick="toggleBannerCarouselAjax({{ $bImg->id }}, this)" class="carousel-toggle-btn px-2.5 py-1 rounded-lg border text-[10px] font-bold flex items-center gap-1 transition-all {{ $inCarousel ? 'bg-emerald-100 text-emerald-800 border-emerald-300 dark:bg-emerald-900/60 dark:text-emerald-200' : 'bg-gray-100 text-gray-600 border-gray-300 dark:bg-gray-800 dark:text-gray-400' }}" title="Incluir / Excluir de la rotación del carrusel">
                                    <span>{{ $inCarousel ? '✓ En Carrusel' : '○ Sin Carrusel' }}</span>
                                </button>

                                <div class="flex items-center gap-1">
                                    <!-- Botón Fijar como Portada Principal -->
                                    <button type="button" onclick="selectBannerFeaturedAjax({{ $bImg->id }}, '{{ $bImg->image_path }}', this)" class="feature-toggle-btn p-1.5 rounded-lg border border-[var(--border-color)] hover:border-amber-400 hover:bg-amber-50 dark:hover:bg-amber-950/40 text-[var(--text-secondary)] hover:text-amber-600 transition-all" title="Fijar como foto de portada principal fija">
                                        <svg class="w-3.5 h-3.5 {{ $isFeatured ? 'text-[#D4AF37] fill-current' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                    </button>

                                    <!-- Botón Quitar / Eliminar Foto -->
                                    <button type="button" onclick="deleteBannerAjax({{ $bImg->id }}, this)" class="p-1.5 rounded-lg border border-[var(--border-color)] hover:border-red-400 hover:bg-red-50 dark:hover:bg-red-950/40 text-[var(--text-muted)] hover:text-red-600 transition-all" title="Quitar foto del catálogo oficial">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Campo oculto para hero_image_preset para compatibilidad con el formulario general -->
                <input type="hidden" name="hero_image_preset" id="hero_image_preset_input" value="{{ $currentImg }}">
            </div>

            <!-- Panel de Degradado Clásico -->
            <div id="media-panel-gradient" class="p-4 rounded-xl bg-emerald-950 text-emerald-100 text-xs space-y-2 border border-emerald-800 {{ $currentMediaType === 'gradient' ? '' : 'hidden' }}">
                <span class="font-bold flex items-center gap-1.5 text-emerald-300">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                    Degradado Molinero Institucional Seleccionado
                </span>
                <p class="text-[11px] text-emerald-200/90 leading-relaxed">
                    La portada mostrará un sobrio degradado de verde institucional Molinero (de oscuro a claro) con patrón radial geométrico sutil, sin fotografías ni videos de fondo.
                </p>
            </div>

            <!-- Panel de Video Local Mejorado con AJAX y Galería -->
            <div id="media-panel-video" class="space-y-4 pt-2 border-t border-[var(--border-color)] {{ $currentMediaType === 'video' ? '' : 'hidden' }}">
                
                <!-- 1. Carga Asíncrona Directa con Barra de Progreso y Enlace Automático -->
                <div class="p-4 rounded-xl border-2 border-dashed border-emerald-400/80 dark:border-emerald-700/80 bg-emerald-50/30 dark:bg-emerald-950/20 space-y-3">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                        <div>
                            <span class="text-xs font-bold text-[#0F5132] dark:text-emerald-400 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                Subida Automática de Video (.mp4, .webm)
                            </span>
                            <p class="text-[11px] text-[var(--text-secondary)]">
                                Seleccione su archivo de video; se subirá con barra de progreso y quedará <strong>enlazado y activo automáticamente</strong>.
                            </p>
                        </div>
                        <label for="ajax_video_file_input" class="btn-molinero text-xs py-2 px-4 cursor-pointer hover:scale-105 transition-all shadow-sm flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            <span>Subir y Enlazar Video</span>
                        </label>
                        <input type="file" id="ajax_video_file_input" accept="video/mp4,video/webm" class="sr-only" onchange="uploadVideoAjax(this)" />
                    </div>

                    <!-- Barra de Progreso en Vivo -->
                    <div id="video_upload_progress_container" class="hidden space-y-1.5 pt-2 border-t border-emerald-200 dark:border-emerald-800">
                        <div class="flex items-center justify-between text-[11px] font-semibold text-[#0F5132] dark:text-emerald-300">
                            <span id="video_upload_status_text">Subiendo video al servidor...</span>
                            <span id="video_upload_percent">0%</span>
                        </div>
                        <div class="w-full h-2.5 rounded-full bg-emerald-200/60 dark:bg-emerald-950 overflow-hidden">
                            <div id="video_upload_progress_bar" class="h-full bg-[#0F5132] dark:bg-emerald-400 rounded-full transition-all duration-150" style="width: 0%;"></div>
                        </div>
                    </div>

                    <!-- Mensaje de Resultado AJAX -->
                    <div id="video_ajax_alert" class="hidden p-3 rounded-lg text-xs font-medium"></div>
                </div>

                <!-- 2. Galería de Videos Disponibles en el Servidor (public/videos/) -->
                <div class="space-y-2 pt-2">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-[var(--text-primary)]">
                            Videos Detectados en la Carpeta del Servidor (public/videos/):
                        </label>
                        <span class="text-[11px] text-[var(--text-muted)]">
                            {{ count($existingVideos ?? []) }} archivo(s) disponibles
                        </span>
                    </div>

                    @if(!empty($existingVideos) && count($existingVideos) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        @php $activeVideo = \App\Models\SiteSetting::get('hero_video_path'); @endphp
                        @foreach($existingVideos as $vid)
                        @php $isActive = ($activeVideo === $vid['path'] || $activeVideo === $vid['filename']); @endphp
                        <div class="p-3 rounded-xl border {{ $isActive ? 'border-emerald-600 bg-emerald-50/70 dark:bg-emerald-950/60 ring-2 ring-emerald-500' : 'border-[var(--border-color)] bg-[var(--bg-surface)] hover:border-gray-400' }} flex flex-col justify-between transition-all">
                            <div class="flex items-start gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/60 flex items-center justify-center text-[#0F5132] dark:text-emerald-300 flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <span class="block text-xs font-bold text-[var(--text-primary)] truncate" title="{{ $vid['filename'] }}">{{ $vid['filename'] }}</span>
                                    <span class="block text-[10px] text-[var(--text-muted)]">{{ $vid['size_mb'] }} MB • {{ $vid['modified_at'] }}</span>
                                </div>
                            </div>
                            <div class="mt-3 pt-2 border-t border-[var(--border-color)] flex items-center justify-between">
                                @if($isActive)
                                <span class="inline-flex items-center gap-1 text-[10px] font-extrabold text-[#0F5132] dark:text-emerald-400">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Activo en Portada
                                </span>
                                @else
                                <button type="button" onclick="selectVideoAjax('{{ $vid['path'] }}')" class="btn-molinero-outline text-[11px] py-1 px-2.5 w-full justify-center">
                                    ⚡ Activar este video
                                </button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="p-3.5 rounded-xl bg-gray-50 dark:bg-gray-800/40 border border-[var(--border-color)] text-xs text-[var(--text-muted)] space-y-1">
                        <p class="font-semibold text-[var(--text-primary)]">No hay videos guardados aún en <code>public/videos/</code>.</p>
                        <p class="text-[11px]">Puede usar el botón superior <strong>"Subir y Enlazar Video"</strong>, o copiar sus archivos de video MP4 directamente a la carpeta del servidor <code>Z:\pruebas1\David\OGI\public\videos\</code> y aparecerán aquí automáticamente para activarlos con un solo clic.</p>
                    </div>
                    @endif
                </div>

                <!-- 3. Campo de Ruta Manual (Opción B tradicional de respaldo) -->
                <div class="space-y-1 pt-2 border-t border-[var(--border-color)]">
                    <label class="block text-xs font-semibold text-[var(--text-secondary)]">Ruta Activa del Video (o URL Externa directa):</label>
                    <input type="text" id="hero_video_path_input" name="hero_video_path_manual" value="{{ \App\Models\SiteSetting::get('hero_video_path') }}" placeholder="Ejemplo: videos/mi_video.mp4 o https://dominio.com/video.mp4" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] font-mono" />
                    <p class="text-[10px] text-[var(--text-muted)]">Ruta relativa o enlace directo al archivo de video en el servidor.</p>
                </div>

                @if(\App\Models\SiteSetting::get('hero_video_path'))
                <div class="p-2.5 bg-emerald-50 dark:bg-emerald-950/40 rounded-lg border border-emerald-300 dark:border-emerald-800 flex items-center justify-between text-xs">
                    <span class="text-emerald-800 dark:text-emerald-300 font-semibold truncate">Video actualmente activo: <strong>{{ \App\Models\SiteSetting::get('hero_video_path') }}</strong></span>
                </div>
                @endif
            </div>

            <!-- Panel de Video YouTube -->
            <div id="media-panel-youtube" class="space-y-3 pt-2 border-t border-[var(--border-color)] {{ $currentMediaType === 'youtube' ? '' : 'hidden' }}">
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Enlace o ID de Video de YouTube:</label>
                <input type="text" name="hero_video_youtube" value="{{ \App\Models\SiteSetting::get('hero_video_youtube') }}" placeholder="https://www.youtube.com/watch?v=XXXXX o sólo el ID" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                <p class="text-[10px] text-[var(--text-muted)]">El video de YouTube se reproducirá automáticamente de fondo en bucle y en silencio absoluto.</p>
            </div>

            <!-- Control de Opacidad del Velo de Contraste -->
            <div class="pt-2 border-t border-[var(--border-color)]">
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Velo Protector de Contraste:</label>
                <div class="flex items-center gap-4">
                    @php $currentOpacity = \App\Models\SiteSetting::get('hero_overlay_opacity', '65'); @endphp
                    <select name="hero_overlay_opacity" class="text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">
                        <option value="40" {{ $currentOpacity == '40' ? 'selected' : '' }}>Ligero (40% oscurecimiento)</option>
                        <option value="55" {{ $currentOpacity == '55' ? 'selected' : '' }}>Medio (55% oscurecimiento)</option>
                        <option value="65" {{ $currentOpacity == '65' ? 'selected' : '' }}>Recomendado (65% oscurecimiento - Óptimo)</option>
                        <option value="80" {{ $currentOpacity == '80' ? 'selected' : '' }}>Intenso (80% oscurecimiento - Máxima legibilidad)</option>
                    </select>
                </div>
            </div>

            <!-- Textos de Portada -->
            <div class="pt-3 border-t border-[var(--border-color)] space-y-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Insignia Superior (Badge)</label>
                        <input type="text" name="hero_badge" value="{{ \App\Models\SiteSetting::get('hero_badge', 'Internacionalización & Cooperación Global') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Título Principal (Español)</label>
                        <input type="text" name="hero_title" value="{{ \App\Models\SiteSetting::get('hero_title', 'Conectando el Conocimiento Molinero con el Mundo') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Título Principal (Inglés)</label>
                        <input type="text" name="hero_title_en" value="{{ \App\Models\SiteSetting::where('key', 'hero_title')->first()?->value_en }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Subtítulo / Bajada</label>
                        <textarea name="hero_subtitle" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ \App\Models\SiteSetting::get('hero_subtitle', 'Lideramos la cooperación interinstitucional, la investigación científica transnacional y las oportunidades de movilidad académica para la comunidad de la Universidad Nacional Agraria La Molina.') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. PRESENTACIÓN INSTITUCIONAL (NUESTRA OFICINA) -->
        <div class="card-molinero p-6 space-y-5">
            <h2 class="text-sm font-bold text-[var(--text-primary)] border-b border-[var(--border-color)] pb-2 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                <span>2. Nuestra Oficina — Presentación Institucional y Dirección</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Etiqueta Superior</label>
                    <input type="text" name="presentation_badge" value="{{ \App\Models\SiteSetting::get('presentation_badge', 'Nuestra Oficina') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Título de la Sección</label>
                    <input type="text" name="presentation_title" value="{{ \App\Models\SiteSetting::get('presentation_title', 'Presentación Institucional') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Nombre del Director(a)</label>
                    <input type="text" name="presentation_director_name" value="{{ \App\Models\SiteSetting::get('presentation_director_name', 'Dr. Christian René Encina Zelada') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Cargo Oficial del Director(a)</label>
                    <input type="text" name="presentation_director_role" value="{{ \App\Models\SiteSetting::get('presentation_director_role', 'Director de la Oficina de Gestión Interinstitucional y Asuntos Globales') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>

                <!-- Fotografía del Director con Recuadro Preview y Opción de Quitar -->
                <div class="sm:col-span-2 space-y-2 p-3.5 bg-gray-50 dark:bg-emerald-950/20 rounded-xl border border-[var(--border-color)]">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-[var(--text-primary)]">Fotografía Oficial del Director(a) / Despacho:</label>
                        <span class="text-[10px] text-[var(--text-muted)]">Aparece en la página pública de Presentación</span>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        @php $photoPath = \App\Models\SiteSetting::get('presentation_director_photo'); @endphp
                        
                        <div class="relative group flex-shrink-0">
                            @if($photoPath && file_exists(public_path($photoPath)))
                                <img src="{{ asset($photoPath) }}" alt="Director" class="w-20 h-24 object-cover object-top rounded-xl border-2 border-emerald-600 shadow-md" />
                            @else
                                <div class="w-20 h-24 rounded-xl border-2 border-dashed border-emerald-400 overflow-hidden bg-emerald-950/40 flex items-center justify-center p-1" title="Foto de Referencia: Pendiente de Subir Foto">
                                    <img src="{{ asset('imagenes/placeholder_referencia.svg') }}" alt="Foto de Referencia" class="w-full h-full object-cover rounded-lg" />
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 space-y-2 w-full">
                            <div>
                                <label class="block text-[11px] font-semibold text-[var(--text-secondary)] mb-1">Subir o Reemplazar Fotografía:</label>
                                <input type="file" name="presentation_director_photo_file" accept="image/*" class="w-full text-xs file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-700 file:text-white hover:file:bg-emerald-800 cursor-pointer border border-[var(--border-color)] rounded-lg p-1 bg-[var(--bg-page)]" />
                                <p class="text-[10px] text-[var(--text-muted)] mt-1">Formato vertical de alta resolución (JPG, PNG o WebP).</p>
                            </div>

                            @if($photoPath && file_exists(public_path($photoPath)))
                            <div class="pt-1">
                                <label class="inline-flex items-center gap-2 text-xs font-bold text-red-600 dark:text-red-400 hover:text-red-700 cursor-pointer p-1.5 rounded-lg hover:bg-red-50 dark:hover:bg-red-950/30 transition-colors border border-transparent hover:border-red-200">
                                    <input type="checkbox" name="remove_presentation_director_photo" value="1" class="rounded text-red-600 focus:ring-red-500 w-4 h-4">
                                    <span>🗑️ Quitar fotografía actual y usar imagen de referencia institucional</span>
                                </label>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Título del Mensaje</label>
                    <input type="text" name="presentation_message_title" value="{{ \App\Models\SiteSetting::get('presentation_message_title', 'Mensaje de Dirección') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Párrafo 1 del Mensaje</label>
                    <textarea name="presentation_message_p1" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ \App\Models\SiteSetting::get('presentation_message_p1', 'La Oficina de Gestión Interinstitucional y Asuntos Globales (OGI) de la Universidad Nacional Agraria La Molina es el órgano encargado de orientar, promover, gestionar y supervisar las relaciones de cooperación académica, científica, cultural y técnica entre nuestra universidad y prestigiosas instituciones nacionales y del exterior.') }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Párrafo 2 del Mensaje</label>
                    <textarea name="presentation_message_p2" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ \App\Models\SiteSetting::get('presentation_message_p2', 'En el versátil y desafiante contexto internacional contemporáneo, nuestra misión es consolidar puentes efectivos que permitan a nuestros estudiantes, docentes e investigadores participar activamente en programas de movilidad global, redes científicas de excelencia y proyectos de investigación transnacionales que aporten al desarrollo sostenible, la seguridad alimentaria y la conservación ambiental del Perú y del planeta.') }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Párrafo 3 del Mensaje</label>
                    <textarea name="presentation_message_p3" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ \App\Models\SiteSetting::get('presentation_message_p3', 'Ponemos a disposición de la comunidad universitaria y de nuestros aliados internacionales este renovado portal, diseñado con altos estándares de accesibilidad, transparencia y gestión directa para conectar el conocimiento molinero con las oportunidades globales.') }}</textarea>
                </div>
            </div>

            <!-- 4 Funciones Principales -->
            <div class="pt-3 border-t border-[var(--border-color)] space-y-3">
                <span class="text-xs font-bold text-[var(--text-primary)] block">Funciones Estratégicas de la OGI (4 Pilares):</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-[11px] font-bold text-[var(--text-secondary)]">Pilar 1: Título y Descripción</label>
                        <input type="text" name="presentation_fn1_title" value="{{ \App\Models\SiteSetting::get('presentation_fn1_title', 'Asesoría y Vinculación Estratégica') }}" class="w-full text-xs px-2.5 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] font-semibold" />
                        <textarea name="presentation_fn1_desc" rows="2" class="w-full text-xs px-2.5 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)]">{{ \App\Models\SiteSetting::get('presentation_fn1_desc', 'Asesorar al Rectorado y a los Consejos de Facultad en materia de formulación, negociación, suscripción y seguimiento de convenios interinstitucionales nacionales e internacionales.') }}</textarea>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-[11px] font-bold text-[var(--text-secondary)]">Pilar 2: Título y Descripción</label>
                        <input type="text" name="presentation_fn2_title" value="{{ \App\Models\SiteSetting::get('presentation_fn2_title', 'Gestión de Movilidad Académica') }}" class="w-full text-xs px-2.5 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] font-semibold" />
                        <textarea name="presentation_fn2_desc" rows="2" class="w-full text-xs px-2.5 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)]">{{ \App\Models\SiteSetting::get('presentation_fn2_desc', 'Administrar las convocatorias de movilidad estudiantil y docente nacional e internacional, brindando acompañamiento continuo a alumnos salientes y alumnos visitantes internacionales.') }}</textarea>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-[11px] font-bold text-[var(--text-secondary)]">Pilar 3: Título y Descripción</label>
                        <input type="text" name="presentation_fn3_title" value="{{ \App\Models\SiteSetting::get('presentation_fn3_title', 'Oferta y Demanda de Becas') }}" class="w-full text-xs px-2.5 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] font-semibold" />
                        <textarea name="presentation_fn3_desc" rows="2" class="w-full text-xs px-2.5 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)]">{{ \App\Models\SiteSetting::get('presentation_fn3_desc', 'Articular la oferta nacional e internacional de becas de estudio e investigación con la demanda formativa de la comunidad universitaria molinera (BEAI, Santander, Alianza del Pacífico, Fulbright, etc.).') }}</textarea>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-[11px] font-bold text-[var(--text-secondary)]">Pilar 4: Título y Descripción</label>
                        <input type="text" name="presentation_fn4_title" value="{{ \App\Models\SiteSetting::get('presentation_fn4_title', 'Redes y Alianzas Globales') }}" class="w-full text-xs px-2.5 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] font-semibold" />
                        <textarea name="presentation_fn4_desc" rows="2" class="w-full text-xs px-2.5 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)]">{{ \App\Models\SiteSetting::get('presentation_fn4_desc', 'Fortalecer la presencia de la UNALM en consorcios interuniversitarios, redes científicas temáticas y foros de cooperación multilateral con agencias de cooperación internacional.') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. MISIÓN, VISIÓN Y VALORES -->
        <div class="card-molinero p-6 space-y-5">
            <h2 class="text-sm font-bold text-[var(--text-primary)] border-b border-[var(--border-color)] pb-2 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                <span>3. Marco Estratégico — Misión, Visión y Valores Molineros</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Etiqueta Superior</label>
                    <input type="text" name="mv_badge" value="{{ \App\Models\SiteSetting::get('mv_badge', 'Marco Estratégico') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Título de la Página</label>
                    <input type="text" name="mv_title" value="{{ \App\Models\SiteSetting::get('mv_title', 'Misión, Visión y Valores') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-[var(--text-primary)] mb-1">Visión Institucional</label>
                    <textarea name="mv_vision_text" rows="3" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ \App\Models\SiteSetting::get('mv_vision_text', 'Posicionar estratégicamente a la UNALM dentro del versátil contexto internacional y ser el centro gestor de los ejes de la internacionalización universitaria: movilidad y cooperación en educación, interculturalidad, investigación y extensión, en las áreas de ciencias agrarias, pecuarias, pesqueras, productivas, económicas, alimentación, sostenibilidad ambiental e innovación.') }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-[var(--text-primary)] mb-1">Misión Institucional</label>
                    <textarea name="mv_mission_text" rows="3" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ \App\Models\SiteSetting::get('mv_mission_text', 'Incrementar el número de vínculos nacionales e internacionales que conlleven a programas de cooperación internacional multidisciplinarios, colaborando con los docentes, alumnos y egresados de la UNALM en los procesos necesarios para su inserción en los referidos programas.') }}</textarea>
                </div>
            </div>

            <!-- Valores Molineros -->
            <div class="pt-3 border-t border-[var(--border-color)] space-y-3">
                <span class="text-xs font-bold text-[var(--text-primary)] block">Valores Molineros (4 Principios Clave):</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="space-y-1 p-3 bg-gray-50 dark:bg-emerald-950/20 rounded-xl border border-[var(--border-color)]">
                        <label class="block text-[11px] font-bold text-[var(--text-primary)]">Valor 1</label>
                        <input type="text" name="mv_val1_title" value="{{ \App\Models\SiteSetting::get('mv_val1_title', 'Compromiso') }}" class="w-full text-xs px-2.5 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] font-bold" />
                        <textarea name="mv_val1_desc" rows="2" class="w-full text-xs px-2 py-1 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)]">{{ \App\Models\SiteSetting::get('mv_val1_desc', 'Dedicación con la excelencia académica y los intereses institucionales.') }}</textarea>
                    </div>

                    <div class="space-y-1 p-3 bg-gray-50 dark:bg-emerald-950/20 rounded-xl border border-[var(--border-color)]">
                        <label class="block text-[11px] font-bold text-[var(--text-primary)]">Valor 2</label>
                        <input type="text" name="mv_val2_title" value="{{ \App\Models\SiteSetting::get('mv_val2_title', 'Identificación') }}" class="w-full text-xs px-2.5 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] font-bold" />
                        <textarea name="mv_val2_desc" rows="2" class="w-full text-xs px-2 py-1 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)]">{{ \App\Models\SiteSetting::get('mv_val2_desc', 'Orgullo por nuestra tradición agrícola, científica y ambiental.') }}</textarea>
                    </div>

                    <div class="space-y-1 p-3 bg-gray-50 dark:bg-emerald-950/20 rounded-xl border border-[var(--border-color)]">
                        <label class="block text-[11px] font-bold text-[var(--text-primary)]">Valor 3</label>
                        <input type="text" name="mv_val3_title" value="{{ \App\Models\SiteSetting::get('mv_val3_title', 'Responsabilidad') }}" class="w-full text-xs px-2.5 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] font-bold" />
                        <textarea name="mv_val3_desc" rows="2" class="w-full text-xs px-2 py-1 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)]">{{ \App\Models\SiteSetting::get('mv_val3_desc', 'Transparencia, rigor técnico y cumplimiento normativo en cada acuerdo.') }}</textarea>
                    </div>

                    <div class="space-y-1 p-3 bg-gray-50 dark:bg-emerald-950/20 rounded-xl border border-[var(--border-color)]">
                        <label class="block text-[11px] font-bold text-[var(--text-primary)]">Valor 4</label>
                        <input type="text" name="mv_val4_title" value="{{ \App\Models\SiteSetting::get('mv_val4_title', 'Comunicación') }}" class="w-full text-xs px-2.5 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] font-bold" />
                        <textarea name="mv_val4_desc" rows="2" class="w-full text-xs px-2 py-1 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)]">{{ \App\Models\SiteSetting::get('mv_val4_desc', 'Diálogo constructivo y oportuno con estudiantes, docentes y aliados globales.') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. REPOSITORIO DOCUMENTAL Y RECURSOS -->
        <div class="card-molinero p-6 space-y-4">
            <h2 class="text-sm font-bold text-[var(--text-primary)] border-b border-[var(--border-color)] pb-2 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-red-600"></span>
                <span>4. Repositorio Documental y Biblioteca de Recursos</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Insignia Superior (Badge)</label>
                    <input type="text" name="resources_badge" value="{{ \App\Models\SiteSetting::get('resources_badge', 'Repositorio Documental') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Título de la Sección</label>
                    <input type="text" name="resources_title" value="{{ \App\Models\SiteSetting::get('resources_title', 'Recursos, Guías y Reglamentos') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Descripción / Subtítulo</label>
                    <textarea name="resources_subtitle" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ \App\Models\SiteSetting::get('resources_subtitle', 'Descarga directa de instructivos de intercambio, normativas institucionales, boletines molineros y consolidados oficiales de convenios.') }}</textarea>
                </div>
            </div>
        </div>

        <!-- 5. DIRECTORIO INSTITUCIONAL (EQUIPO) -->
        <div class="card-molinero p-6 space-y-4">
            <h2 class="text-sm font-bold text-[var(--text-primary)] border-b border-[var(--border-color)] pb-2 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                <span>5. Directorio Institucional (Encabezados del Equipo de Gestión)</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Insignia Superior (Badge)</label>
                    <input type="text" name="team_badge" value="{{ \App\Models\SiteSetting::get('team_badge', 'Directorio Institucional') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Título de la Sección</label>
                    <input type="text" name="team_title" value="{{ \App\Models\SiteSetting::get('team_title', 'Equipo de Gestión OGI') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Descripción / Subtítulo</label>
                    <textarea name="team_subtitle" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ \App\Models\SiteSetting::get('team_subtitle', 'Profesionales comprometidos con el acompañamiento y servicio a la comunidad universitaria en temas de movilidad, becas y convenios.') }}</textarea>
                </div>
            </div>
        </div>

        <!-- 6. CANALES DE ATENCIÓN Y CONTACTO -->
        <div class="card-molinero p-6 space-y-4">
            <h2 class="text-sm font-bold text-[var(--text-primary)] border-b border-[var(--border-color)] pb-2 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                <span>6. Canales de Atención y Contacto Institucional</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Insignia Superior (Badge)</label>
                    <input type="text" name="contact_badge" value="{{ \App\Models\SiteSetting::get('contact_badge', 'Canales de Atención') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Título de la Sección</label>
                    <input type="text" name="contact_title" value="{{ \App\Models\SiteSetting::get('contact_title', 'Contacto Institucional') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Subtítulo / Bajada</label>
                    <textarea name="contact_subtitle" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ \App\Models\SiteSetting::get('contact_subtitle', 'Comunícate con nuestro equipo directivo y coordinadores para consultas sobre convenios, movilidad académica y oportunidades de becas.') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Correo Electrónico Oficial</label>
                    <input type="email" name="contact_email" value="{{ \App\Models\SiteSetting::get('contact_email', 'ogi@lamolina.edu.pe') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Central Telefónica y Anexos</label>
                    <input type="text" name="contact_phone" value="{{ \App\Models\SiteSetting::get('contact_phone', '(01) 614-7800 Anexos 212 (Dirección), 215 (Movilidad), 218 (Convenios)') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Dirección Física del Campus</label>
                    <textarea name="contact_address" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ \App\Models\SiteSetting::get('contact_address', "Av. La Molina s/n, La Molina — Lima, Perú\nCampus Universitario UNALM (Edificio del Rectorado, 2.° Piso)") }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Horario de Atención Presencial</label>
                    <input type="text" name="contact_hours" value="{{ \App\Models\SiteSetting::get('contact_hours', 'Lunes a Viernes de 8:00 a.m. a 4:00 p.m.') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>

                <!-- Pasos de Propuesta de Convenio -->
                <div class="sm:col-span-2 pt-2 border-t border-[var(--border-color)] space-y-3">
                    <span class="text-xs font-bold text-[var(--text-primary)] block">Guía para Nuevos Socios y Propuestas de Convenio:</span>
                    <div>
                        <label class="block text-[11px] font-semibold text-[var(--text-secondary)] mb-1">Título de la Guía</label>
                        <input type="text" name="contact_proposal_title" value="{{ \App\Models\SiteSetting::get('contact_proposal_title', 'Para Socios e Instituciones Extranjeras') }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-[var(--text-secondary)] mb-1">Introducción</label>
                        <textarea name="contact_proposal_desc" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ \App\Models\SiteSetting::get('contact_proposal_desc', 'Si representa a una universidad, organismo de investigación o entidad internacional y desea iniciar el trámite para suscribir un nuevo Convenio Marco o Convenio Específico de Movilidad con la UNALM:') }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold text-[var(--text-secondary)]">Paso 1</label>
                            <textarea name="contact_step1" rows="2" class="w-full text-xs px-2 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)]">{{ \App\Models\SiteSetting::get('contact_step1', 'Remita una carta de intención formal firmada por la autoridad competente de su institución.') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-[var(--text-secondary)]">Paso 2</label>
                            <textarea name="contact_step2" rows="2" class="w-full text-xs px-2 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)]">{{ \App\Models\SiteSetting::get('contact_step2', 'Adjunte la propuesta preliminar de convenio y señale las facultades o carreras de mutuo interés.') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-[var(--text-secondary)]">Paso 3</label>
                            <textarea name="contact_step3" rows="2" class="w-full text-xs px-2 py-1.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)]">{{ \App\Models\SiteSetting::get('contact_step3', 'Envíe la documentación digital al correo institucional: ogi@lamolina.edu.pe.') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between p-4 bg-[var(--bg-surface)] rounded-2xl border border-[var(--border-color)] shadow-2xl sticky bottom-4 z-20 backdrop-blur-md">
            <button type="button" onclick="autoTranslateForm(this)" class="btn-molinero-outline text-xs flex items-center gap-2 py-2.5 px-4 font-bold shadow-sm">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>✨ Auto-traducir Textos a Inglés</span>
            </button>
            <button type="submit" class="btn-molinero text-sm py-3 px-8 font-bold shadow-lg hover:scale-105 transition-all">
                Guardar Todos los Cambios Institucionales
            </button>
        </div>
    </form>
</div>

<script>
// Sincronizador visual instantáneo para tarjetas de radio
function updateRadioCardVisuals(groupName) {
    const radios = document.querySelectorAll(`input[type="radio"][name="${groupName}"]`);
    radios.forEach(radio => {
        const label = radio.closest('label');
        if (!label) return;
        if (radio.checked) {
            label.classList.add('border-[#0F5132]', 'bg-emerald-50/60', 'dark:bg-emerald-950/40', 'ring-2', 'ring-[#0F5132]', 'shadow-md');
            label.classList.remove('border-[var(--border-color)]', 'hover:border-gray-400');
        } else {
            label.classList.remove('border-[#0F5132]', 'bg-emerald-50/60', 'dark:bg-emerald-950/40', 'ring-2', 'ring-[#0F5132]', 'shadow-md');
            label.classList.add('border-[var(--border-color)]');
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            updateRadioCardVisuals(this.name);
            if (this.name === 'hero_media_type') {
                toggleMediaFields(this.value);
            }
        });
    });
});

function toggleMediaFields(type) {
    const imgPanel = document.getElementById('media-panel-image');
    const vidPanel = document.getElementById('media-panel-video');
    const ytPanel = document.getElementById('media-panel-youtube');
    const gradPanel = document.getElementById('media-panel-gradient');
    const carouselNotice = document.getElementById('carousel-mode-notice');
    const imageNotice = document.getElementById('image-mode-notice');

    if (imgPanel) imgPanel.classList.toggle('hidden', type !== 'image' && type !== 'carousel');
    if (vidPanel) vidPanel.classList.toggle('hidden', type !== 'video');
    if (ytPanel) ytPanel.classList.toggle('hidden', type !== 'youtube');
    if (gradPanel) gradPanel.classList.toggle('hidden', type !== 'gradient');

    if (carouselNotice) carouselNotice.classList.toggle('hidden', type !== 'carousel');
    if (imageNotice) imageNotice.classList.toggle('hidden', type !== 'image');
}

// Subida AJAX de Foto de Portada / Carrusel
function uploadBannerAjax(input) {
    if (!input.files || !input.files[0]) return;
    const file = input.files[0];
    const titleInput = document.getElementById('ajax_banner_title_input');
    const title = titleInput ? titleInput.value : '';

    const progressContainer = document.getElementById('banner_upload_progress_container');
    const progressBar = document.getElementById('banner_upload_progress_bar');
    const progressPercent = document.getElementById('banner_upload_percent');
    const statusText = document.getElementById('banner_upload_status_text');
    const alertBox = document.getElementById('banner_ajax_alert');

    progressContainer.classList.remove('hidden');
    alertBox.classList.add('hidden');
    progressBar.style.width = '0%';
    progressPercent.textContent = '0%';
    statusText.textContent = `Subiendo "${file.name}" (${(file.size / (1024 * 1024)).toFixed(1)} MB)...`;

    const formData = new FormData();
    formData.append('image_file', file);
    if (title) formData.append('title', title);
    formData.append('_token', '{{ csrf_token() }}');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route("admin.settings.upload_banner") }}', true);

    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            const pct = Math.round((e.loaded / e.total) * 100);
            progressBar.style.width = pct + '%';
            progressPercent.textContent = pct + '%';
            if (pct === 100) {
                statusText.textContent = 'Guardando y registrando en el catálogo...';
            }
        }
    };

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            try {
                const res = JSON.parse(xhr.responseText);
                if (res.success) {
                    alertBox.className = 'p-3 rounded-lg bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-300 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-xs font-semibold';
                    alertBox.innerHTML = `✓ ${res.message}`;
                    alertBox.classList.remove('hidden');

                    if (titleInput) titleInput.value = '';
                    setTimeout(() => window.location.reload(), 1200);
                } else {
                    showBannerError(res.message || 'Error al procesar la imagen.');
                }
            } catch (err) {
                showBannerError('Respuesta inesperada del servidor.');
            }
        } else {
            showBannerError(`Error en el servidor al subir la imagen (HTTP ${xhr.status}).`);
        }
    };

    xhr.onerror = function() {
        showBannerError('Error de conexión con el servidor.');
    };

    xhr.send(formData);

    function showBannerError(msg) {
        alertBox.className = 'p-3 rounded-lg bg-red-50 dark:bg-red-950/40 border border-red-300 dark:border-red-800 text-red-800 dark:text-red-300 text-xs font-medium';
        alertBox.innerHTML = msg;
        alertBox.classList.remove('hidden');
        progressContainer.classList.add('hidden');
    }
}

// Alternar Foto en Carrusel
function toggleBannerCarouselAjax(id, btn) {
    btn.disabled = true;
    fetch(`{{ url('intranet/ajustes/toggle-banner-carousel') }}/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(r => r.json())
    .then(res => {
        btn.disabled = false;
        if (res.success) {
            if (res.is_active_carousel) {
                btn.className = 'carousel-toggle-btn px-2.5 py-1 rounded-lg border text-[10px] font-bold flex items-center gap-1 transition-all bg-emerald-100 text-emerald-800 border-emerald-300 dark:bg-emerald-900/60 dark:text-emerald-200';
                btn.innerHTML = '<span>✓ En Carrusel</span>';
            } else {
                btn.className = 'carousel-toggle-btn px-2.5 py-1 rounded-lg border text-[10px] font-bold flex items-center gap-1 transition-all bg-gray-100 text-gray-600 border-gray-300 dark:bg-gray-800 dark:text-gray-400';
                btn.innerHTML = '<span>○ Sin Carrusel</span>';
            }
        }
    })
    .catch(() => {
        btn.disabled = false;
        alert('Error al actualizar estado en carrusel.');
    });
}

// Fijar Foto como Portada Principal
function selectBannerFeaturedAjax(id, path, btn) {
    btn.disabled = true;
    fetch(`{{ url('intranet/ajustes/select-banner-featured') }}/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(r => r.json())
    .then(res => {
        btn.disabled = false;
        if (res.success) {
            // Actualizar tarjetas
            document.querySelectorAll('.banner-photo-card').forEach(card => {
                card.classList.remove('border-[#0F5132]', 'bg-emerald-50/50', 'dark:bg-emerald-950/40', 'ring-2', 'ring-[#0F5132]');
                card.classList.add('border-[var(--border-color)]', 'bg-[var(--bg-surface)]');
                const badge = card.querySelector('.featured-badge');
                if (badge) badge.classList.add('hidden');
                const star = card.querySelector('.feature-toggle-btn svg');
                if (star) {
                    star.classList.remove('text-[#D4AF37]', 'fill-current');
                }
            });

            const currentCard = document.getElementById(`banner-card-${id}`);
            if (currentCard) {
                currentCard.classList.remove('border-[var(--border-color)]', 'bg-[var(--bg-surface)]');
                currentCard.classList.add('border-[#0F5132]', 'bg-emerald-50/50', 'dark:bg-emerald-950/40', 'ring-2', 'ring-[#0F5132]');
                const badge = currentCard.querySelector('.featured-badge');
                if (badge) badge.classList.remove('hidden');
                const star = currentCard.querySelector('.feature-toggle-btn svg');
                if (star) {
                    star.classList.add('text-[#D4AF37]', 'fill-current');
                }
            }

            const presetInput = document.getElementById('hero_image_preset_input');
            if (presetInput) presetInput.value = path;
        }
    })
    .catch(() => {
        btn.disabled = false;
        alert('Error al fijar la foto de portada.');
    });
}

// Eliminar Foto del Catálogo
function deleteBannerAjax(id, btn) {
    if (!confirm('¿Está seguro de que desea quitar esta fotografía del catálogo oficial de portadas?')) {
        return;
    }

    btn.disabled = true;
    fetch(`{{ url('intranet/ajustes/delete-banner') }}/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            const card = document.getElementById(`banner-card-${id}`);
            if (card) {
                card.style.opacity = '0';
                card.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    card.remove();
                    // Reindexar números visibles
                    document.querySelectorAll('.banner-photo-card .order-num').forEach((span, i) => {
                        span.textContent = i + 1;
                    });
                }, 300);
            }
        } else {
            btn.disabled = false;
            alert(res.message || 'No se pudo eliminar la foto.');
        }
    })
    .catch(() => {
        btn.disabled = false;
        alert('Error al comunicarse con el servidor.');
    });
}

// Mover orden secuencial de foto en el carrusel
function moveBannerOrderAjax(id, direction) {
    fetch(`{{ url('intranet/ajustes/reorder-banner') }}/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ direction: direction })
    })
    .then(r => r.json())
    .then(res => {
        if (res.success && res.banners) {
            const grid = document.getElementById('banner-cards-grid');
            if (grid) {
                res.banners.forEach((item, index) => {
                    const card = document.getElementById(`banner-card-${item.id}`);
                    if (card) {
                        grid.appendChild(card);
                        const numSpan = card.querySelector('.order-num');
                        if (numSpan) numSpan.textContent = index + 1;
                    }
                });
            }
        }
    })
    .catch(() => {
        alert('Error al actualizar el orden de rotación.');
    });
}

function uploadVideoAjax(input) {
    if (!input.files || !input.files[0]) return;
    const file = input.files[0];

    const progressContainer = document.getElementById('video_upload_progress_container');
    const progressBar = document.getElementById('video_upload_progress_bar');
    const progressPercent = document.getElementById('video_upload_percent');
    const statusText = document.getElementById('video_upload_status_text');
    const alertBox = document.getElementById('video_ajax_alert');

    progressContainer.classList.remove('hidden');
    alertBox.classList.add('hidden');
    progressBar.style.width = '0%';
    progressPercent.textContent = '0%';
    statusText.textContent = `Subiendo "${file.name}" (${(file.size / (1024 * 1024)).toFixed(1)} MB)...`;

    const formData = new FormData();
    formData.append('video_file', file);
    formData.append('_token', '{{ csrf_token() }}');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route("admin.settings.upload_video") }}', true);

    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            const pct = Math.round((e.loaded / e.total) * 100);
            progressBar.style.width = pct + '%';
            progressPercent.textContent = pct + '%';
            if (pct === 100) {
                statusText.textContent = 'Procesando y activando en la portada...';
            }
        }
    };

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            try {
                const res = JSON.parse(xhr.responseText);
                if (res.success) {
                    alertBox.className = 'p-3 rounded-lg bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-300 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-xs font-semibold';
                    alertBox.innerHTML = `✓ ${res.message} <br><span class="font-normal text-[11px]">Ruta asignada: <code>${res.path}</code> (${res.size_mb} MB)</span>`;
                    alertBox.classList.remove('hidden');

                    const pathInput = document.getElementById('hero_video_path_input');
                    if (pathInput) pathInput.value = res.path;

                    setTimeout(() => window.location.reload(), 1500);
                } else {
                    showUploadError(res.message || 'Error al procesar el archivo.');
                }
            } catch (err) {
                showUploadError('Respuesta inesperada del servidor.');
            }
        } else if (xhr.status === 413) {
            showUploadError(`⚠️ Error 413: El archivo (${(file.size / (1024 * 1024)).toFixed(1)} MB) supera el límite de transferencia HTTP del proxy universitario. <br><strong>Solución recomendada:</strong> Copie el archivo directamente a la carpeta de red <code>Z:\\pruebas1\\David\\OGI\\public\\videos\\</code> y aparecerá automáticamente abajo para activarlo con 1 clic.`);
        } else {
            showUploadError(`Error en el servidor (HTTP ${xhr.status}).`);
        }
    };

    xhr.onerror = function() {
        showUploadError('Error de conexión con el servidor.');
    };

    xhr.send(formData);

    function showUploadError(msg) {
        alertBox.className = 'p-3 rounded-lg bg-red-50 dark:bg-red-950/40 border border-red-300 dark:border-red-800 text-red-800 dark:text-red-300 text-xs font-medium';
        alertBox.innerHTML = msg;
        alertBox.classList.remove('hidden');
        progressContainer.classList.add('hidden');
    }
}

function selectVideoAjax(path) {
    const alertBox = document.getElementById('video_ajax_alert');
    if (alertBox) {
        alertBox.className = 'p-3 rounded-lg bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-300 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-xs font-semibold';
        alertBox.innerHTML = `Activando video: ${path}...`;
        alertBox.classList.remove('hidden');
    }

    fetch('{{ route("admin.settings.select_video") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ path: path })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const pathInput = document.getElementById('hero_video_path_input');
            if (pathInput) pathInput.value = path;
            window.location.reload();
        }
    })
    .catch(() => {
        const pathInput = document.getElementById('hero_video_path_input');
        if (pathInput) pathInput.value = path;
        alert('Video seleccionado. Guarde los cambios al final de la página.');
    });
}
</script>
@endsection

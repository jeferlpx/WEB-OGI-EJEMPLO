@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'International Student Testimonials ?" UNALM' : 'Testimonio de los Alumnos Extranjeros ?" UNALM')

@section('content')
<!-- Hero Header -->
<section class="bg-gradient-to-r from-emerald-950 via-[#0F5132] to-emerald-900 text-white py-12 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-wrap items-center gap-2 text-xs uppercase font-bold tracking-wider text-emerald-300 mb-2">
            <a href="{{ route('mobility.incoming') }}" class="hover:underline flex items-center gap-1">
                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Incoming Mobility' : 'Movilidad Entrante' }}</span>
            </a>
            <span>?</span>
            <span class="text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Student Testimonials' : 'Testimonios' }}</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-1 mb-3">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Testimonials of International Students' : 'Testimonio de los Alumnos Extranjeros' }}
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed max-w-3xl">
            {{ ($currentLocale ?? 'es') === 'en'
                ? 'Discover the academic, scientific, and cultural experiences of international students who chose Universidad Nacional Agraria La Molina for their exchange stay.'
                : 'Conoce de primera mano las experiencias acadǸmicas, cientficas y culturales de jvenes de universidades de Europa y AmǸrica Latina que cursaron sus estudios en la Universidad Nacional Agraria La Molina.' }}
        </p>
    </div>
</section>

<!-- Subnavegacin de Movilidad Entrante -->
<div class="bg-[var(--bg-surface)] border-b border-[var(--border-color)] sticky top-20 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 overflow-x-auto py-2.5 text-xs font-semibold whitespace-nowrap scrollbar-none">
            <span class="text-[var(--text-muted)] uppercase tracking-wider text-[11px] pr-2 border-r border-[var(--border-color)]">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Incoming Options:' : 'Opciones Entrantes:' }}
            </span>
            <a href="{{ route('mobility.incoming') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Study at UNALM' : 'Estudia en la UNALM' }}
            </a>
            <a href="{{ route('mobility.special_programs') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Special Programs' : 'Programas Especiales' }}
            </a>
            <a href="{{ route('mobility.testimonies') }}" class="px-3 py-1.5 rounded-lg bg-[#0F5132] text-white">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Foreign Student Testimonials' : 'Testimonio de Extranjeros' }}
            </a>
            <a href="{{ asset('documentos/Guia_del_alumno_de_intercambio.pdf') }}" target="_blank" rel="noopener noreferrer" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors flex items-center gap-1">
                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Student Handbook (PDF)' : 'Gua del Estudiante Extranjero' }}</span>
                <svg class="w-3 h-3 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
            </a>
            <a href="{{ route('mobility.delegations') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Delegations Visits' : 'Visita de Delegaciones' }}
            </a>
            <a href="{{ route('mobility.summer_camp') }}" class="px-3 py-1.5 rounded-lg text-amber-700 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-950/40 transition-colors">
                Summer Camp UNALM
            </a>
        </div>
    </div>
</div>

@php
    $testimonies = [
        ['src' => 'imagenes/movilidad/textranjeros/1.jpg', 'title' => 'Testimonio 1', 'desc' => 'Experiencia acadǸmica en Agronoma y Ciencias Biolgicas'],
        ['src' => 'imagenes/movilidad/textranjeros/2.jpg', 'title' => 'Testimonio 2', 'desc' => 'Estancia cientfica en investigacin agropecuaria'],
        ['src' => 'imagenes/movilidad/textranjeros/3.jpg', 'title' => 'Testimonio 3', 'desc' => 'Vida universitaria en el campus de La Molina'],
        ['src' => 'imagenes/movilidad/textranjeros/4.jpg', 'title' => 'Testimonio 4', 'desc' => 'Prǭcticas de campo en los Institutos Regionales de Desarrollo'],
        ['src' => 'imagenes/movilidad/textranjeros/5.jpg', 'title' => 'Testimonio 5', 'desc' => 'Convivencia estudiantil internacional en Lima'],
        ['src' => 'imagenes/movilidad/textranjeros/6.jpg', 'title' => 'Testimonio 6', 'desc' => 'Desarrollo de proyectos de investigacin aplicada'],
        ['src' => 'imagenes/movilidad/textranjeros/f1.jpg', 'title' => 'Testimonio 7', 'desc' => 'Intercambio estudiantil de movilidad entrante'],
        ['src' => 'imagenes/movilidad/textranjeros/f2.jpg', 'title' => 'Testimonio 8', 'desc' => 'Experiencia en industrias alimentarias y ambiente'],
        ['src' => 'imagenes/movilidad/textranjeros/f3.jpg', 'title' => 'Testimonio 9', 'desc' => 'Comunidad y cultura universitaria molinera'],
    ];
@endphp

<section class="py-12 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <!-- Carrusel Principal con Controles Interactivos -->
    <div class="card-molinero p-6 sm:p-8 overflow-hidden">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-[var(--border-color)]">
            <div>
                <h2 class="text-xl font-bold text-[var(--text-primary)]">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Featured Testimonials Carousel' : 'Galera de Testimonios Oficiales' }}
                </h2>
                <p class="text-xs text-[var(--text-muted)] mt-0.5">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Click left/right or any thumbnail to browse testimonies' : 'Desliza o haz clic en las miniaturas para explorar cada testimonio' }}
                </p>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" id="prevTestimonyBtn" class="p-2 rounded-lg border border-[var(--border-color)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 text-[var(--text-secondary)] hover:text-[#0F5132] transition-colors" aria-label="Anterior">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <span id="testimonyCounter" class="text-xs font-bold text-emerald-800 dark:text-emerald-300 px-2">1 / {{ count($testimonies) }}</span>
                <button type="button" id="nextTestimonyBtn" class="p-2 rounded-lg border border-[var(--border-color)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 text-[var(--text-secondary)] hover:text-[#0F5132] transition-colors" aria-label="Siguiente">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        <!-- Visor del Testimonio Activo -->
        <div class="relative bg-black/5 dark:bg-black/30 rounded-2xl overflow-hidden flex items-center justify-center p-2 sm:p-4 min-h-[360px] sm:min-h-[500px]">
            <img id="activeTestimonyImg" src="{{ asset($testimonies[0]['src']) }}" alt="{{ $testimonies[0]['title'] }}" class="max-h-[550px] w-auto max-w-full rounded-xl shadow-lg object-contain transition-all duration-300 cursor-zoom-in" onclick="openLightbox(this.src, this.alt)" />
        </div>

        <!-- Miniaturas de Seleccin -->
        <div class="flex items-center gap-3 overflow-x-auto mt-6 pb-2 scrollbar-thin">
            @foreach($testimonies as $idx => $t)
                <button type="button" onclick="selectTestimony({{ $idx }})" class="testimony-thumb flex-shrink-0 w-20 h-14 sm:w-24 sm:h-16 rounded-lg overflow-hidden border-2 transition-all {{ $idx === 0 ? 'border-[#0F5132] ring-2 ring-emerald-400' : 'border-[var(--border-color)] opacity-70 hover:opacity-100' }}">
                    <img src="{{ asset($t['src']) }}" alt="{{ $t['title'] }}" class="w-full h-full object-cover" />
                </button>
            @endforeach
        </div>
    </div>

    <!-- Cuadrcula Completa de Testimonios para Lectura Rpida -->
    <div>
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-[var(--text-primary)] flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-[#0F5132]"></span>
                {{ ($currentLocale ?? 'es') === 'en' ? 'All Testimonies in High Definition' : 'Todos los Testimonios en Alta Resolucin' }}
            </h3>
            <span class="text-xs text-[var(--text-muted)]">{{ count($testimonies) }} {{ ($currentLocale ?? 'es') === 'en' ? 'testimonies published' : 'testimonios molineros' }}</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonies as $idx => $t)
                <div class="card-molinero overflow-hidden group cursor-pointer hover:border-[#0F5132] transition-all" onclick="openLightbox('{{ asset($t['src']) }}', '{{ $t['title'] }}')">
                    <div class="relative overflow-hidden bg-gray-100 dark:bg-gray-900 aspect-[4/3] flex items-center justify-center">
                        <img src="{{ asset($t['src']) }}" alt="{{ $t['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" />
                        <div class="absolute inset-0 bg-emerald-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white">
                            <span class="px-3 py-1.5 rounded-lg bg-black/60 backdrop-blur-sm text-xs font-semibold flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                                {{ ($currentLocale ?? 'es') === 'en' ? 'Click to Enlarge' : 'Ampliar Testimonio' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-xs font-bold text-[var(--text-primary)]">
                            <span>{{ $t['title'] }}</span>
                            <span class="text-[10px] text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950 px-2 py-0.5 rounded">UNALM</span>
                        </div>
                        <p class="text-[11px] text-[var(--text-muted)] mt-1">
                            {{ $t['desc'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Invitacin a Postular -->
    <div class="card-molinero p-8 bg-gradient-to-r from-emerald-50 via-white to-emerald-50/50 dark:from-emerald-950/30 dark:via-[var(--bg-surface)] dark:to-emerald-950/20 border-emerald-300 dark:border-emerald-800 text-center space-y-4">
        <h3 class="text-xl font-bold text-[var(--text-primary)]">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Want to Experience an Academic Exchange at UNALM?' : 'Te gustara ser el prximo estudiante de intercambio en La Molina?' }}
        </h3>
        <p class="text-xs sm:text-sm text-[var(--text-secondary)] max-w-2xl mx-auto leading-relaxed">
            {{ ($currentLocale ?? 'es') === 'en'
                ? 'Join our vibrant campus community in Lima, validate academic credits in our 12 degree programs, and discover the natural diversity of Peru.'
                : 'Unete a nuestra comunidad universitaria en Lima, convalida asignaturas oficiales en nuestras 12 carreras profesionales y vive una experiencia transformadora.' }}
        </p>
        <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
            <a href="{{ route('mobility.incoming') }}" class="btn-molinero text-xs">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Study at UNALM (Requirements)' : 'Ver Requisitos de Postulacin' }}
            </a>
            <a href="{{ asset('documentos/Guia_del_alumno_de_intercambio.pdf') }}" target="_blank" rel="noopener noreferrer" class="px-4 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-surface)] hover:bg-gray-100 dark:hover:bg-gray-800 text-xs font-bold text-[var(--text-primary)] transition-colors">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Download Handbook (PDF)' : 'Descargar Gua del Estudiante (PDF)' }}
            </a>
        </div>
    </div>
</section>

<!-- Lightbox Modal para Ampliar Imgenes -->
<div id="testimonyLightbox" class="fixed inset-0 z-50 bg-black/90 backdrop-blur-sm hidden items-center justify-center p-4" onclick="closeLightbox()">
    <div class="relative max-w-4xl max-h-[90vh] flex flex-col items-center" onclick="event.stopPropagation()">
        <button type="button" onclick="closeLightbox()" class="absolute -top-10 right-0 text-white hover:text-emerald-400 transition-colors p-2 text-sm font-bold flex items-center gap-1">
            <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Close' : 'Cerrar' }}</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <img id="lightboxImg" src="" alt="" class="max-h-[85vh] max-w-full rounded-xl shadow-2xl object-contain" />
    </div>
</div>

<script>
    const testimoniesData = @json($testimonies);
    let currentIndex = 0;

    function selectTestimony(index) {
        currentIndex = index;
        const activeImg = document.getElementById('activeTestimonyImg');
        const counter = document.getElementById('testimonyCounter');
        const thumbs = document.querySelectorAll('.testimony-thumb');

        if (activeImg) {
            activeImg.src = "{{ asset('') }}" + testimoniesData[index].src;
            activeImg.alt = testimoniesData[index].title;
        }

        if (counter) {
            counter.textContent = `${index + 1} / ${testimoniesData.length}`;
        }

        thumbs.forEach((th, idx) => {
            if (idx === index) {
                th.classList.add('border-[#0F5132]', 'ring-2', 'ring-emerald-400');
                th.classList.remove('opacity-70');
            } else {
                th.classList.remove('border-[#0F5132]', 'ring-2', 'ring-emerald-400');
                th.classList.add('opacity-70');
            }
        });
    }

    document.getElementById('prevTestimonyBtn')?.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + testimoniesData.length) % testimoniesData.length;
        selectTestimony(currentIndex);
    });

    document.getElementById('nextTestimonyBtn')?.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % testimoniesData.length;
        selectTestimony(currentIndex);
    });

    function openLightbox(src, alt) {
        const lb = document.getElementById('testimonyLightbox');
        const img = document.getElementById('lightboxImg');
        if (lb && img) {
            img.src = src;
            img.alt = alt;
            lb.classList.remove('hidden');
            lb.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeLightbox() {
        const lb = document.getElementById('testimonyLightbox');
        if (lb) {
            lb.classList.add('hidden');
            lb.classList.remove('flex');
            document.body.style.overflow = '';
        }
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });
</script>
@endsection


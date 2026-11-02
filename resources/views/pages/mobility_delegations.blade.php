@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'Delegation Visits & Protocol Signs ?" UNALM' : 'Visita de Delegaciones y Firmas Institucionales ?" UNALM')

@section('content')
<!-- Hero Header -->
<section class="bg-gradient-to-r from-emerald-950 via-[#0F5132] to-emerald-900 text-white py-12 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-wrap items-center gap-2 text-xs uppercase font-bold tracking-wider text-emerald-300 mb-2">
            <a href="{{ route('mobility.incoming') }}" class="hover:underline flex items-center gap-1">
                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Incoming Mobility' : 'Movilidad Entrante' }}</span>
            </a>
            <span>?</span>
            <span class="text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Delegations Visits' : 'Visita de Delegaciones' }}</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-1 mb-3">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Official Delegation Visits & Agreement Signings' : 'Visita de Delegaciones' }}
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed max-w-3xl">
            {{ ($currentLocale ?? 'es') === 'en'
                ? 'High-level diplomatic, academic, and scientific delegations hosted at the UNALM Rectorate, establishing bilateral cooperation and strategic alliances.'
                : 'Visitas protocolares de delegaciones universitarias, embajadas y organismos cientficos internacionales recibidas en el Rectorado de la UNALM para la suscripcin de convenios de cooperacin.' }}
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
            <a href="{{ route('mobility.testimonies') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Foreign Student Testimonials' : 'Testimonio de Extranjeros' }}
            </a>
            <a href="{{ asset('documentos/Guia_del_alumno_de_intercambio.pdf') }}" target="_blank" rel="noopener noreferrer" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors flex items-center gap-1">
                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Student Handbook (PDF)' : 'Gua del Estudiante Extranjero' }}</span>
                <svg class="w-3 h-3 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
            </a>
            <a href="{{ route('mobility.delegations') }}" class="px-3 py-1.5 rounded-lg bg-[#0F5132] text-white">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Delegations Visits' : 'Visita de Delegaciones' }}
            </a>
            <a href="{{ route('mobility.summer_camp') }}" class="px-3 py-1.5 rounded-lg text-amber-700 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-950/40 transition-colors">
                Summer Camp UNALM
            </a>
        </div>
    </div>
</div>

@php
    $delegations = [
        [
            'title' => 'Visita de la Universidad de Purdue (EE.UU.)',
            'title_en' => 'Visit of Purdue University Delegation (USA)',
            'desc' => 'Encuentro institucional de alto nivel y cooperacin cientfica entre autoridades de Purdue University y el Rectorado de la UNALM para programas de investigacin conjunta y movilidad.',
            'desc_en' => 'High-level institutional and scientific cooperation meeting between Purdue University leadership and UNALM Rectorate for joint research and mobility.',
            'badge' => 'Estados Unidos',
            'photos' => [
                'imagenes/movilidad/delegaciones/purdue/1.JPG',
                'imagenes/movilidad/delegaciones/purdue/2.JPG',
                'imagenes/movilidad/delegaciones/purdue/3.JPG',
            ]
        ],
        [
            'title' => 'Firma de Convenio con el Grupo AJE',
            'title_en' => 'Agreement Signing with AJE Group',
            'desc' => 'Acto protocolar de suscripcin de convenio de cooperacin interinstitucional entre la UNALM y el Grupo AJE, orientado a proyectos de sostenibilidad ambiental, economa circular y biocomercio.',
            'desc_en' => 'Official signing ceremony of inter-institutional cooperation agreement between UNALM and AJE Group for environmental sustainability and bio-trade projects.',
            'badge' => 'Alianza EstratǸgica',
            'photos' => [
                'imagenes/movilidad/delegaciones/AJE/1.JPG',
                'imagenes/movilidad/delegaciones/AJE/2.JPG',
                'imagenes/movilidad/delegaciones/AJE/3.JPG',
            ]
        ],
        [
            'title' => 'Firma de Convenio con la Universidad Nacional de Huancavelica',
            'title_en' => 'Agreement with Universidad Nacional de Huancavelica',
            'desc' => 'Acuerdo de movilidad docente, investigacin agropecuaria andina y fortalecimiento institucional mutuo entre casas de estudio pblicas peruanas.',
            'desc_en' => 'Bilateral agreement for faculty mobility, Andean agricultural research, and mutual institutional strengthening between Peruvian public universities.',
            'badge' => 'Nacional',
            'photos' => [
                'imagenes/movilidad/delegaciones/HUANCAVELICA/1.JPG',
                'imagenes/movilidad/delegaciones/HUANCAVELICA/2.JPG',
                'imagenes/movilidad/delegaciones/HUANCAVELICA/3.JPG',
            ]
        ],
        [
            'title' => 'Visita de la Delegacin de la Universidad Agraria de Eslovaquia',
            'title_en' => 'Visit of the Slovak University of Agriculture Delegation',
            'desc' => 'Reunin de trabajo con autoridades y docentes de Eslovaquia para el intercambio de estudiantes y docentes en ciencias agrarias y ambientales en el marco del programa Erasmus+.',
            'desc_en' => 'Work meeting with faculty leadership from Slovakia to foster student and researcher exchange in agriculture under the Erasmus+ framework.',
            'badge' => 'Unin Europea',
            'photos' => [
                'imagenes/movilidad/delegaciones/ESLOVAQUIA/1.JPG',
                'imagenes/movilidad/delegaciones/ESLOVAQUIA/2.JPG',
                'imagenes/movilidad/delegaciones/ESLOVAQUIA/3.JPG',
            ]
        ],
        [
            'title' => 'Firma de Convenio con SENAMHI',
            'title_en' => 'Agreement Signing with SENAMHI (Meteorological Service)',
            'desc' => 'Firma de convenio marco de cooperacin tǸcnica y cientfica con el Servicio Nacional de Meteorologa e Hidrologa del Per (SENAMHI) para el desarrollo de investigacin agrometeorolgica.',
            'desc_en' => 'Signing of technical and scientific framework agreement with Peru\'s National Meteorology and Hydrology Service (SENAMHI) for agrometeorological research.',
            'badge' => 'Entidad Pblica',
            'photos' => [
                'imagenes/movilidad/delegaciones/SENAMHI/1.JPG',
                'imagenes/movilidad/delegaciones/SENAMHI/2.JPG',
                'imagenes/movilidad/delegaciones/SENAMHI/3.JPG',
            ]
        ],
        [
            'title' => 'Visita de Delegacin AcadǸmica de China',
            'title_en' => 'Visit of Academic Delegation from China',
            'desc' => 'Dilogo acadǸmico para la cooperacin tecnolgica agraria y programas de intercambio con instituciones de la Repblica Popular China.',
            'desc_en' => 'Academic dialogue on agricultural technological cooperation and exchange programs with Chinese scientific institutions.',
            'badge' => 'Asia',
            'photos' => [
                'imagenes/movilidad/delegaciones/Visita_Delegacion_China/1.jpg',
                'imagenes/movilidad/delegaciones/Visita_Delegacion_China/2.jpg',
                'imagenes/movilidad/delegaciones/Visita_Delegacion_China/3.jpg',
            ]
        ],
        [
            'title' => 'Visita de la Delegacin de la Repblica de Corea',
            'title_en' => 'Visit of Delegation from the Republic of Korea',
            'desc' => 'Encuentro bilateral con delegaciones coreanas y organismos de cooperacin tǸcnica para la modernizacin de laboratorios agrarios y bioeconoma.',
            'desc_en' => 'Bilateral meeting with Korean delegations and technical agencies to modernize agricultural laboratory infrastructure and bioeconomy.',
            'badge' => 'Asia',
            'photos' => [
                'imagenes/movilidad/delegaciones/Visita_delegacion_Corea/1.jpg',
                'imagenes/movilidad/delegaciones/Visita_delegacion_Corea/2.jpg',
                'imagenes/movilidad/delegaciones/Visita_delegacion_Corea/3.jpg',
            ]
        ],
    ];
@endphp

<section class="py-12 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    @foreach($delegations as $d)
        <div class="card-molinero p-6 sm:p-8 space-y-5">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-[var(--border-color)] pb-4">
                <div>
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-[#0F5132] dark:bg-emerald-950 dark:text-emerald-300 mb-1">
                        {{ $d['badge'] }}
                    </span>
                    <h2 class="text-lg sm:text-xl font-bold text-[var(--text-primary)]">
                        {{ ($currentLocale ?? 'es') === 'en' ? $d['title_en'] : $d['title'] }}
                    </h2>
                </div>
                <div class="flex items-center gap-1.5 text-xs text-emerald-700 dark:text-emerald-400 font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>{{ count($d['photos']) }} {{ ($currentLocale ?? 'es') === 'en' ? 'Photos' : 'Fotografas' }}</span>
                </div>
            </div>

            <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                {{ ($currentLocale ?? 'es') === 'en' ? $d['desc_en'] : $d['desc'] }}
            </p>

            <!-- Galera de Fotos de la Delegacin -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @foreach($d['photos'] as $p)
                    <div class="rounded-xl overflow-hidden border border-[var(--border-color)] bg-black/5 dark:bg-black/30 aspect-[4/3] group relative cursor-pointer" onclick="openLightbox('{{ asset($p) }}', '{{ $d['title'] }}')">
                        <img src="{{ asset($p) }}" alt="{{ $d['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" />
                        <div class="absolute inset-0 bg-emerald-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="p-2 rounded-lg bg-black/60 text-white text-xs font-semibold flex items-center gap-1">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                                {{ ($currentLocale ?? 'es') === 'en' ? 'Zoom' : 'Ampliar' }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</section>

<!-- Lightbox Modal -->
<div id="delegationLightbox" class="fixed inset-0 z-50 bg-black/90 backdrop-blur-sm hidden items-center justify-center p-4" onclick="closeLightbox()">
    <div class="relative max-w-4xl max-h-[90vh] flex flex-col items-center" onclick="event.stopPropagation()">
        <button type="button" onclick="closeLightbox()" class="absolute -top-10 right-0 text-white hover:text-emerald-400 transition-colors p-2 text-sm font-bold flex items-center gap-1">
            <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Close' : 'Cerrar' }}</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <img id="lightboxImg" src="" alt="" class="max-h-[85vh] max-w-full rounded-xl shadow-2xl object-contain" />
    </div>
</div>

<script>
    function openLightbox(src, alt) {
        const lb = document.getElementById('delegationLightbox');
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
        const lb = document.getElementById('delegationLightbox');
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


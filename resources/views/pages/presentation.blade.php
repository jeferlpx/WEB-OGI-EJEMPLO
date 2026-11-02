@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'Institutional Presentation — OGI UNALM' : 'Presentación Institucional — OGI UNALM')

@section('content')
@php
    $photoPath = \App\Models\SiteSetting::get('presentation_director_photo');
    $directorName = \App\Models\SiteSetting::get('presentation_director_name', $director->name ?? 'Dra. Fabiola Otilia Olivares Ponce');
    $directorRole = \App\Models\SiteSetting::get('presentation_director_role', ($currentLocale ?? 'es') === 'en' ? 'Director of the Office of Inter-institutional Management and Global Affairs' : ($director->role_title ?? 'Directora de la Oficina de Gestión Interinstitucional y Asuntos Globales'));
@endphp

<!-- Cabecera Institucional Dinámica -->
<section class="bg-gradient-to-r from-emerald-950 via-[#0F5132] to-[#0A3622] text-white py-14 border-b border-emerald-900/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs uppercase font-bold tracking-wider text-emerald-300">
            {{ \App\Models\SiteSetting::get('presentation_badge', 'Nuestra Oficina', $currentLocale ?? 'es') }}
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white mt-1">
            {{ \App\Models\SiteSetting::get('presentation_title', 'Presentación Institucional', $currentLocale ?? 'es') }}
        </h1>
    </div>
</section>

<section class="py-14 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
    <!-- Mensaje de Dirección con Fotografía Oficial Destacada -->
    <div class="card-molinero p-8 sm:p-10 shadow-lg">
        <div class="flex flex-col md:flex-row gap-8 lg:gap-10 items-center md:items-start">
            <!-- Recuadro Grande de Fotografía Oficial del Director -->
            <div class="w-full sm:w-56 md:w-64 flex-shrink-0 text-center">
                <div class="w-48 h-56 sm:w-52 sm:h-60 mx-auto rounded-2xl overflow-hidden bg-gradient-to-br from-emerald-900 to-[#0A3622] flex items-center justify-center border-4 border-emerald-600/40 shadow-2xl mb-4 relative">
                    @if($photoPath && file_exists(public_path($photoPath)))
                    <img src="{{ asset($photoPath) }}" alt="{{ $directorName }}" class="w-full h-full object-cover object-top" />
                    @else
                    <img src="{{ asset('imagenes/placeholder_referencia' . (($currentLocale ?? 'es') === 'en' ? '_en' : '') . '.svg') }}" alt="{{ ($currentLocale ?? 'es') === 'en' ? 'Official reference photo pending upload' : 'Fotografía oficial de referencia pendiente de carga' }}" class="w-full h-full object-cover" />
                    @endif
                </div>
                <h3 class="text-sm font-bold text-[var(--text-primary)] leading-tight">{{ $directorName }}</h3>
                <p class="text-xs text-emerald-700 dark:text-emerald-400 font-medium mt-1">{{ $directorRole }}</p>
                <p class="text-[11px] text-[var(--text-muted)] mt-0.5">Universidad Nacional Agraria La Molina</p>
            </div>

            <!-- Contenido y Mensaje de Dirección Administrable -->
            <div class="w-full md:flex-1 space-y-4 text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                <h2 class="text-xl sm:text-2xl font-extrabold text-[var(--text-primary)]">
                    {{ \App\Models\SiteSetting::get('presentation_message_title', ($currentLocale ?? 'es') === 'en' ? "Director's Message" : 'Mensaje de Dirección', $currentLocale ?? 'es') }}
                </h2>
                
                @if(($currentLocale ?? 'es') === 'en')
                    <p>
                        The <strong>Office of Inter-institutional Management and Global Affairs (OGI)</strong> of the Universidad Nacional Agraria La Molina is the university governing body responsible for guiding, promoting, managing, and overseeing academic, scientific, cultural, and technical cooperation relationships between our university and prestigious national and international institutions.
                    </p>
                    <p>
                        In today's versatile and challenging global landscape, our mission is to build effective bridges that enable our students, faculty, and researchers to actively participate in global mobility programs, scientific networks of excellence, and transnational research projects that contribute to sustainable development, food security, and environmental conservation in Peru and the planet.
                    </p>
                    <p>
                        We place this renewed portal at the service of the university community and our global partners, designed according to high standards of accessibility, transparency, and direct communication to connect Molinero knowledge with world-class opportunities.
                    </p>
                @else
                    <p>
                        La <strong>Oficina de Gestión Interinstitucional y Asuntos Globales (OGI)</strong> de la Universidad Nacional Agraria La Molina es el órgano encargado de orientar, promover, gestionar y supervisar las relaciones de cooperación académica, científica, cultural y técnica entre nuestra universidad y prestigiosas instituciones nacionales y del exterior.
                    </p>
                    <p>
                        En el versátil y desafiante contexto internacional contemporáneo, nuestra misión es consolidar puentes efectivos que permitan a nuestros estudiantes, docentes e investigadores participar activamente en programas de movilidad global, redes científicas de excelencia y proyectos de investigación transnacionales que aporten al desarrollo sostenible, la seguridad alimentaria y la conservación ambiental del Perú y del planeta.
                    </p>
                    <p>
                        Ponemos a disposición de la comunidad universitaria y de nuestros aliados internacionales este renovado portal, diseñado con altos estándares de accesibilidad, transparencia y gestión directa para conectar el conocimiento molinero con las oportunidades globales.
                    </p>
                @endif
            </div>
        </div>
    </div>

    <!-- Funciones Principales Administrables -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="card-molinero p-6">
            <h3 class="text-base font-bold text-[var(--text-primary)] mb-3 flex items-center gap-2">
                <span class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 text-[#0F5132] dark:text-emerald-400 flex items-center justify-center text-xs font-bold">1</span>
                <span>{{ \App\Models\SiteSetting::get('presentation_fn1_title', 'Asesoría y Vinculación Estratégica', $currentLocale ?? 'es') }}</span>
            </h3>
            <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                {{ \App\Models\SiteSetting::get('presentation_fn1_desc', 'Asesorar al Rectorado y a los Consejos de Facultad en materia de formulación, negociación, suscripción y seguimiento de convenios interinstitucionales nacionales e internacionales.', $currentLocale ?? 'es') }}
            </p>
        </div>

        <div class="card-molinero p-6">
            <h3 class="text-base font-bold text-[var(--text-primary)] mb-3 flex items-center gap-2">
                <span class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 text-[#0F5132] dark:text-emerald-400 flex items-center justify-center text-xs font-bold">2</span>
                <span>{{ \App\Models\SiteSetting::get('presentation_fn2_title', 'Gestión de Movilidad Académica', $currentLocale ?? 'es') }}</span>
            </h3>
            <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                {{ \App\Models\SiteSetting::get('presentation_fn2_desc', 'Administrar las convocatorias de movilidad estudiantil y docente nacional e internacional, brindando acompañamiento continuo a alumnos salientes y alumnos visitantes internacionales.', $currentLocale ?? 'es') }}
            </p>
        </div>

        <div class="card-molinero p-6">
            <h3 class="text-base font-bold text-[var(--text-primary)] mb-3 flex items-center gap-2">
                <span class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 text-[#0F5132] dark:text-emerald-400 flex items-center justify-center text-xs font-bold">3</span>
                <span>{{ \App\Models\SiteSetting::get('presentation_fn3_title', 'Oferta y Demanda de Becas', $currentLocale ?? 'es') }}</span>
            </h3>
            <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                {{ \App\Models\SiteSetting::get('presentation_fn3_desc', 'Articular la oferta nacional e internacional de becas de estudio e investigación con la demanda formativa de la comunidad universitaria molinera (BEAI, Santander, Alianza del Pacífico, Fulbright, etc.).', $currentLocale ?? 'es') }}
            </p>
        </div>

        <div class="card-molinero p-6">
            <h3 class="text-base font-bold text-[var(--text-primary)] mb-3 flex items-center gap-2">
                <span class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 text-[#0F5132] dark:text-emerald-400 flex items-center justify-center text-xs font-bold">4</span>
                <span>{{ \App\Models\SiteSetting::get('presentation_fn4_title', 'Redes y Alianzas Globales', $currentLocale ?? 'es') }}</span>
            </h3>
            <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                {{ \App\Models\SiteSetting::get('presentation_fn4_desc', 'Fortalecer la presencia de la UNALM en consorcios interuniversitarios, redes científicas temáticas y foros de cooperación multilateral con agencias de cooperación internacional.', $currentLocale ?? 'es') }}
            </p>
        </div>
    </div>
</section>
@endsection

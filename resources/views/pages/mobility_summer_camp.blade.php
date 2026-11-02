@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'La Molina Summer Camp ?" International Academic Program | UNALM' : 'Summer Camp UNALM ?" Programa Internacional | UNALM')

@section('content')
<!-- Hero Header -->
<section class="bg-gradient-to-r from-emerald-950 via-[#0F5132] to-emerald-900 text-white py-12 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-wrap items-center gap-2 text-xs uppercase font-bold tracking-wider text-emerald-300 mb-2">
            <a href="{{ route('home') }}" class="hover:underline flex items-center gap-1">
                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Portal' : 'Inicio' }}</span>
            </a>
            <span>?</span>
            <a href="{{ route('mobility.incoming') }}" class="hover:underline">
                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Mobility' : 'Movilidad' }}</span>
            </a>
            <span>?</span>
            <span class="text-white">Summer Camp</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-1 mb-3">
            {{ ($currentLocale ?? 'es') === 'en' ? 'La Molina Summer Camp & Field Programs' : 'Summer Camp UNALM' }}
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed max-w-3xl">
            {{ ($currentLocale ?? 'es') === 'en'
                ? 'An intensive three-week learning and scientific fieldwork program across Peru\'s coastal desert, Andean highlands, and Amazon rainforest.'
                : 'Programa intensivo de aprendizaje, investigacin aplicada y prǭcticas de campo durante tres semanas en los Institutos Regionales de Desarrollo (IRDs) de la Costa, Sierra y Selva del Perǧ.' }}
        </p>
    </div>
</section>

<!-- Subnavegacin de Opciones de Movilidad -->
<div class="bg-[var(--bg-surface)] border-b border-[var(--border-color)] sticky top-20 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 overflow-x-auto py-2.5 text-xs font-semibold whitespace-nowrap scrollbar-none">
            <span class="text-[var(--text-muted)] uppercase tracking-wider text-[11px] pr-2 border-r border-[var(--border-color)]">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Mobility Directory:' : 'Navegacin Movilidad:' }}
            </span>
            <a href="{{ route('mobility.incoming') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Incoming Mobility' : 'Movilidad Entrante' }}
            </a>
            <a href="{{ route('mobility.outgoing') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Outgoing Mobility' : 'Movilidad Saliente' }}
            </a>
            <a href="{{ route('mobility.excellence') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                Excelencia AcadǸmica (BEAI)
            </a>
            <a href="{{ route('mobility.summer_camp') }}" class="px-3 py-1.5 rounded-lg bg-[#0F5132] text-white">
                Summer Camp UNALM
            </a>
        </div>
    </div>
</div>

<section class="py-12 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <!-- Presentacin Principal del Summer Camp -->
    <div class="card-molinero p-6 sm:p-8 space-y-6">
        <div class="flex flex-col md:flex-row gap-6 items-center">
            <div class="w-full md:w-3/5 space-y-4 text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-[#0F5132] dark:bg-emerald-950 dark:text-emerald-300">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'International Field Experience' : 'Experiencia de Campo Internacional' }}
                </span>
                <h2 class="text-xl sm:text-2xl font-bold text-[var(--text-primary)]">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Purpose & Academic Program' : 'Propsito del Summer Camp' }}
                </h2>
                <p>
                    {!! ($currentLocale ?? 'es') === 'en'
                        ? '<strong>La Molina Summer Camp</strong> is an intensive three-week learning and research program in agriculture, biodiversity, and natural resource management across the arid coastal desert, Andean highlands, and Amazonian rainforest of Peru. It offers participants the opportunity to earn transferable academic credits, gain hands-on field experience, and build international cooperation networks.'
                        : 'El <strong>Summer Camp de la Universidad Nacional Agraria La Molina</strong> es un programa de aprendizaje e investigacin cientfica aplicada de tres semanas de duracin, desarrollado en los ecosistemas nicos de la costa desǸrtica, los valles andinos y la selva amaznica del Perǧ. Brinda la oportunidad de convalidar crǸditos acadǸmicos, adquirir experiencia de campo invaluable y tejer redes de cooperacin internacional.' !!}
                </p>
                <p>
                    {{ ($currentLocale ?? 'es') === 'en'
                        ? 'The purpose of the program is to expand knowledge in agroecology, tropical livestock systems, soil management, and biodiversity conservation, strengthening bonds between Peruvian Molinero students and international scholars.'
                        : 'El propsito central es profundizar conocimientos prǭcticos en agroecologa, gestin ganadera sostenible, conservacin de recursos forestales y biodiversidad, fortaleciendo vnculos directos entre estudiantes molineros y universitarios de todo el mundo.' }}
                </p>
            </div>

            <div class="w-full md:w-2/5">
                <div class="rounded-2xl overflow-hidden shadow-xl border border-[var(--border-color)]">
                    <img src="{{ asset('imagenes/movilidad/summer_camp/1.jpg') }}" alt="Summer Camp UNALM - Investigacin y Campo" class="w-full h-auto object-cover" />
                </div>
            </div>
        </div>
    </div>

    <!-- Proyecto Emblemǭtico: Summer School Alemania (Universidad de Hohenheim) -->
    <div class="card-molinero p-6 sm:p-8 space-y-6">
        <div class="flex items-center gap-3 border-b border-[var(--border-color)] pb-4">
            <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-950 text-amber-700 dark:text-amber-400 flex items-center justify-center font-bold">
                DAAD
            </div>
            <div>
                <h3 class="text-lg font-bold text-[var(--text-primary)]">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Project Summer School Germany ?" University of Hohenheim' : 'Proyecto Summer Camp Alemania ?" Universidad de Hohenheim' }}
                </h3>
                <span class="text-xs text-[var(--text-muted)]">Cooperacin bilateral financiada por el Servicio Alemǭn de Intercambio AcadǸmico (DAAD)</span>
            </div>
        </div>

        <div class="space-y-4 text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
            <p>
                El Rectorado de la Universidad Nacional Agraria La Molina en coordinacin con la prestigiosa <strong>Universidad de Hohenheim de Alemania</strong> desarrollaron el proyecto <em>?Summer School-Alemania?</em> para el dictado del curso internacional <em>?Land use dynamics in Peru?</em>.
            </p>
            <p>
                El proyecto consisti en actividades acadǸmicas y prǭcticas de campo durante dos semanas en las instalaciones de los <strong>Institutos Regionales de Desarrollo (IRDs) de la Costa, Sierra y Selva</strong> de la UNALM. Involucr a 5 docentes y 22 estudiantes de Hohenheim, as como a 5 profesores y 15 estudiantes molineros de las facultades de <strong>Agronoma, Zootecnia, Ingeniera Ambiental, Meteorologa, Ciencias Forestales y Economa</strong>.
            </p>
            <p>
                El financiamiento otorgado por el <strong>Servicio Alemǭn de Intercambio AcadǸmico (DAAD)</strong> permiti financiar ntegramente la movilidad y estada de los estudiantes molineros, posibilitando a la delegacin internacional experimentar la diversidad de prǭcticas agrcolas, pecuarias y pesqueras en las tres regiones naturales del pas.
            </p>
        </div>

        <!-- Convenio Bilateral de Continuidad -->
        <div class="p-5 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 space-y-3">
            <h4 class="text-xs sm:text-sm font-bold text-emerald-900 dark:text-emerald-200 flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span>Firma de Convenio Bilateral con la Universidad de Hohenheim</span>
            </h4>
            <p class="text-xs text-[var(--text-secondary)]">
                Al trmino del Summer School se oficializ la firma del convenio bilateral marco y especfico con la presencia de las mǭximas autoridades universitarias, acordando lneas permanentes de cooperacin cientfica:
            </p>
            <ul class="text-xs text-[var(--text-secondary)] space-y-1.5 list-disc pl-5">
                <li>Intercambio de miembros del personal cientfico, docente, administrativo y estudiantes.</li>
                <li>Desarrollo e implementacin de proyectos de investigacin conjunta en cambio climǭtico y dinǭmica del uso de la tierra.</li>
                <li>Organizacin de congresos, conferencias, simposios y escuelas internacionales de campo.</li>
                <li>Intercambio de material cientfico, publicaciones conjuntas y transferencia tecnolgica.</li>
            </ul>
        </div>
    </div>
</section>
@endsection


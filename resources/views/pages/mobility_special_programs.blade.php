@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'Special Programs ?" Incoming Academic Mobility | UNALM' : 'Programas Especiales ?" Movilidad Entrante | UNALM')

@section('content')
<!-- Hero Header -->
<section class="bg-gradient-to-r from-emerald-950 via-[#0F5132] to-emerald-900 text-white py-12 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-wrap items-center gap-2 text-xs uppercase font-bold tracking-wider text-emerald-300 mb-2">
            <a href="{{ route('mobility.incoming') }}" class="hover:underline flex items-center gap-1">
                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Incoming Mobility' : 'Movilidad Entrante' }}</span>
            </a>
            <span>?</span>
            <span class="text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Special Programs' : 'Programas Especiales' }}</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-1 mb-3">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Special Mobility & Research Programs' : 'Programas Especiales' }}
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed max-w-3xl">
            {{ ($currentLocale ?? 'es') === 'en'
                ? 'Tailored academic stays, research internships, short fieldwork programs, and specialized training specified in bilateral university agreements.'
                : 'Pasantas, estancias de investigacin cientfica, prǭcticas de campo y movilidades acadǸmicas especficas de corta duracin contempladas en convenios bilaterales de la UNALM.' }}
        </p>
    </div>
    <div class="absolute right-0 bottom-0 translate-x-12 translate-y-8 opacity-10 pointer-events-none">
        <svg class="w-80 h-80 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
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
            <a href="{{ route('mobility.special_programs') }}" class="px-3 py-1.5 rounded-lg bg-[#0F5132] text-white">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Special Programs' : 'Programas Especiales' }}
            </a>
            <a href="{{ route('mobility.testimonies') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
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

<section class="py-12 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
    <!-- Presentacin y Alcance -->
    <div class="card-molinero p-6 sm:p-8">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950/80 text-[#0F5132] dark:text-emerald-400 flex items-center justify-center flex-shrink-0 shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
            </div>
            <div class="space-y-3 text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                <h2 class="text-xl font-bold text-[var(--text-primary)]">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'About UNALM Special Programs' : 'En quǸ consisten los Programas Especiales?' }}
                </h2>
                <p>
                    {{ ($currentLocale ?? 'es') === 'en'
                        ? 'Special programs at the Universidad Nacional Agraria La Molina consist of internships, research stays, laboratory fieldwork, thesis projects, and short-term academic exchanges stipulated under inter-institutional bilateral agreements.'
                        : 'Los programas especiales en la UNALM consisten en pasantas, estancias de investigacin, prǭcticas profesionales o preprofesionales, desarrollo de tesis y toda modalidad de movilidad contemplada especficamente en los convenios de cooperacin entre universidades.' }}
                </p>
                <p>
                    {{ ($currentLocale ?? 'es') === 'en'
                        ? 'This mobility track is designed for short to mid-term stays focusing on specific scientific disciplines, research clusters, agricultural laboratories, or field institutes (IRDs) across Peru\'s coastal, Andean, and Amazonian regions.'
                        : 'Este mǸtodo de intercambio se considera de duracin flexible o corta e involucra prioritariamente ǭreas, disciplinas especializadas, laboratorios de investigacin aplicada o trabajos en los Institutos Regionales de Desarrollo (IRDs) de la Costa, Sierra y Selva del Perǧ.' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Requisitos de Postulacin -->
    <div class="card-molinero p-6 sm:p-8">
        <h3 class="text-lg font-bold text-[var(--text-primary)] mb-2 flex items-center gap-2">
            <svg class="w-5 h-5 text-[#0F5132] dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ ($currentLocale ?? 'es') === 'en' ? 'Application Requirements & Procedures' : 'Cmo puedo realizar uno de estos Programas Especiales?' }}
        </h3>
        <p class="text-xs text-[var(--text-muted)] mb-6">
            {{ ($currentLocale ?? 'es') === 'en' ? 'The visiting candidate must submit the following official documentation:' : 'El estudiante o investigador interesado deberǭ presentar el siguiente expediente de postulacin:' }}
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Requisito 1 -->
            <div class="p-4 rounded-xl border border-[var(--border-color)] bg-[var(--bg-page)] space-y-2">
                <div class="flex items-center gap-2 text-xs font-bold text-emerald-800 dark:text-emerald-300">
                    <span class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center text-xs">1</span>
                    <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Official Nomination Letter' : 'Carta de Presentacin Oficial' }}</span>
                </div>
                <p class="text-xs text-[var(--text-secondary)]">
                    {{ ($currentLocale ?? 'es') === 'en'
                        ? 'Issued by the home university, addressed to the Director of the Office of Inter-institutional Management and Global Affairs: Dr. Christian René Encina Zelada.'
                        : 'Carta de presentacin institucional de la universidad de origen, dirigida al Director de la Oficina de Gestin Interinstitucional y Asuntos Globales (OGI / ORI): Dr. Christian RenǸ Encina Zelada.' }}
                </p>
            </div>

            <!-- Requisito 2 -->
            <div class="p-4 rounded-xl border border-[var(--border-color)] bg-[var(--bg-page)] space-y-2">
                <div class="flex items-center gap-2 text-xs font-bold text-emerald-800 dark:text-emerald-300">
                    <span class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center text-xs">2</span>
                    <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Official Application Form' : 'Formato de Postulacin' }}</span>
                </div>
                <p class="text-xs text-[var(--text-secondary)]">
                    {{ ($currentLocale ?? 'es') === 'en'
                        ? 'Request the formal application form by emailing ogi@lamolina.edu.pe with copy to becas.ogi@lamolina.edu.pe.'
                        : 'El interesado deberǭ solicitar el formato de postulacin oficial escribiendo a: ogi@lamolina.edu.pe con copia a becas.ogi@lamolina.edu.pe.' }}
                </p>
            </div>

            <!-- Requisito 3 -->
            <div class="p-4 rounded-xl border border-[var(--border-color)] bg-[var(--bg-page)] space-y-2">
                <div class="flex items-center gap-2 text-xs font-bold text-emerald-800 dark:text-emerald-300">
                    <span class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center text-xs">3</span>
                    <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Research Proposal / Work Plan' : 'Plan de Trabajo o Informe de Investigacin' }}</span>
                </div>
                <p class="text-xs text-[var(--text-secondary)]">
                    {{ ($currentLocale ?? 'es') === 'en'
                        ? 'A detailed proposal outlining research topics, laboratory objectives, and field activities so a specialist professor can be assigned as faculty tutor.'
                        : 'Informe detallado de la investigacin o pasanta a realizar en la UNALM, indicando temas para asignar la tutora acadǸmica de un docente especialista de la facultad afn.' }}
                </p>
            </div>

            <!-- Requisito 4 -->
            <div class="p-4 rounded-xl border border-[var(--border-color)] bg-[var(--bg-page)] space-y-2">
                <div class="flex items-center gap-2 text-xs font-bold text-emerald-800 dark:text-emerald-300">
                    <span class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center text-xs">4</span>
                    <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Valid Passport & Insurance' : 'Pasaporte y Seguro Internacional' }}</span>
                </div>
                <p class="text-xs text-[var(--text-secondary)]">
                    {{ ($currentLocale ?? 'es') === 'en'
                        ? 'Clear copy of valid passport and proof of international health/medical insurance with repatriation coverage valid throughout the stay in Peru.'
                        : 'Copia legible del pasaporte vigente y pliza de seguro mǸdico internacional con cobertura integral durante toda la estancia acadǸmica en el Perǧ.' }}
                </p>
            </div>
        </div>

        <!-- Instruccin de Envo -->
        <div class="mt-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-xs text-[var(--text-secondary)]">
                <span class="font-bold text-emerald-900 dark:text-emerald-200 block mb-0.5">{{ ($currentLocale ?? 'es') === 'en' ? 'Submission of Dossier:' : 'Envo de Expediente Digital:' }}</span>
                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Send all required documents in PDF format to:' : 'Remitir todos los documentos escaneados en formato PDF a los correos:' }}</span>
                <span class="font-semibold text-[#0F5132] dark:text-emerald-400 block sm:inline sm:ml-1">ogi@lamolina.edu.pe | becas.ogi@lamolina.edu.pe</span>
            </div>
            <a href="mailto:ogi@lamolina.edu.pe?subject=Postulacion%20Programa%20Especial%20UNALM" class="btn-molinero text-xs whitespace-nowrap">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Send Application' : 'Postular por Correo' }}
            </a>
        </div>
    </div>

    <!-- Mdulos y Enlaces Adicionales Administrables -->
    @if(isset($customModules) && $customModules->isNotEmpty())
        <div class="space-y-4">
            <h3 class="text-base font-bold text-[var(--text-primary)] flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-[#0F5132]"></span>
                {{ ($currentLocale ?? 'es') === 'en' ? 'Additional Resources & Modules (OGI CMS)' : 'Mdulos y Enlaces Vinculados' }}
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($customModules as $module)
                    <a href="{{ $module->url }}" target="{{ $module->target }}" class="card-molinero p-4 group hover:border-[#0F5132] transition-all flex flex-col justify-between">
                        <div>
                            @if($module->badge)
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-[#0F5132] dark:bg-emerald-950 dark:text-emerald-300 mb-2">
                                    {{ $module->getTranslated('badge') }}
                                </span>
                            @endif
                            <h4 class="text-xs font-bold text-[var(--text-primary)] group-hover:text-[#0F5132] dark:group-hover:text-emerald-400 transition-colors">
                                {{ $module->getTranslated('title') }}
                            </h4>
                            @if($module->summary)
                                <p class="text-[11px] text-[var(--text-muted)] mt-1 line-clamp-2">
                                    {{ $module->getTranslated('summary') }}
                                </p>
                            @endif
                        </div>
                        <div class="mt-3 flex items-center justify-end text-[11px] font-semibold text-emerald-700 dark:text-emerald-400 gap-1">
                            <span>{{ ($currentLocale ?? 'es') === 'en' ? 'View details' : 'Ver detalle' }}</span>
                            <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection


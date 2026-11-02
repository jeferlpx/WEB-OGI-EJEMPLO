@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'Study at UNALM — International Exchange Students' : 'Movilidad Entrante — Estudia en la UNALM')

@section('content')
<section class="bg-gradient-to-r from-emerald-950 to-[#0F5132] text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs uppercase font-bold tracking-wider text-emerald-300">
            {{ ($currentLocale ?? 'es') === 'en' ? 'International Student Mobility' : 'Para Estudiantes Internacionales' }}
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-1 mb-3">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Study at UNALM — Lima, Peru' : 'Estudia en la UNALM' }}
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed max-w-3xl">
            {{ ($currentLocale ?? 'es') === 'en' 
                ? 'Join Peru\'s leading agricultural, biological and environmental university. Spend an academic semester or full year exploring our 12 degree programs on our beautiful Lima campus.' 
                : 'Te invitamos a ser parte de nuestra comunidad universitaria y realizar un semestre de intercambio en la universidad líder del Perú en ciencias agrarias, biológicas y ambientales.' }}
        </p>
    </div>
</section>

<!-- Subnavegación de Movilidad Entrante -->
<div class="bg-[var(--bg-surface)] border-b border-[var(--border-color)] sticky top-20 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 overflow-x-auto py-2.5 text-xs font-semibold whitespace-nowrap scrollbar-none">
            <span class="text-[var(--text-muted)] uppercase tracking-wider text-[11px] pr-2 border-r border-[var(--border-color)]">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Incoming Options:' : 'Opciones Entrantes:' }}
            </span>
            <a href="{{ route('mobility.incoming') }}" class="px-3 py-1.5 rounded-lg bg-[#0F5132] text-white">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Study at UNALM' : 'Estudia en la UNALM' }}
            </a>
            <a href="{{ route('mobility.special_programs') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Special Programs' : 'Programas Especiales' }}
            </a>
            <a href="{{ route('mobility.testimonies') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Foreign Student Testimonials' : 'Testimonio de Extranjeros' }}
            </a>
            <a href="{{ asset('documentos/Guia_del_alumno_de_intercambio.pdf') }}" target="_blank" rel="noopener noreferrer" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors flex items-center gap-1">
                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Student Handbook (PDF)' : 'Guía del Estudiante Extranjero' }}</span>
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

<section class="py-12 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <!-- Bienvenida e Introducción -->
    <div class="card-molinero p-8">
        <div class="flex flex-col md:flex-row gap-8 items-center">
            <div class="w-full md:w-2/3 space-y-4 text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                <h2 class="text-xl font-bold text-[var(--text-primary)]">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Welcome to La Molina' : '¿Quieres estudiar en la UNALM?' }}
                </h2>
                <p>
                    {{ ($currentLocale ?? 'es') === 'en'
                        ? 'The Universidad Nacional Agraria La Molina offers 12 undergraduate degree programs where visiting international students can take specialized coursework, engage in fieldwork, and collaborate with leading researchers in biodiversity, forestry, food science, and agronomy.'
                        : 'La UNALM cuenta con 12 carreras profesionales en las cuales podrás cursar asignaturas de tu especialidad, realizar prácticas de campo y participar de proyectos de investigación aplicada que complementen tu malla curricular.' }}
                </p>
                <p>
                    {{ ($currentLocale ?? 'es') === 'en'
                        ? 'The first step is checking whether your home university holds an active student exchange agreement with UNALM. If your institution does not have a formal agreement yet, our offices can coordinate to establish one by contacting ogi@lamolina.edu.pe.'
                        : 'El primer paso para realizar un intercambio académico es revisar que tu universidad de origen mantenga un convenio vigente con la UNALM. Si aún no existe convenio, las oficinas internacionales de ambas instituciones pueden coordinar su suscripción escribiendo a ogi@lamolina.edu.pe.' }}
                </p>
            </div>

            <div class="w-full md:w-1/3 flex flex-col items-center p-6 bg-emerald-50 dark:bg-emerald-950/30 rounded-xl border border-emerald-200 dark:border-emerald-800 text-center">
                <svg class="w-12 h-12 text-[#0F5132] dark:text-emerald-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <h4 class="text-xs font-bold text-[var(--text-primary)] mb-1">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Exchange Student Handbook' : 'Guía del Estudiante Extranjero' }}
                </h4>
                <p class="text-[11px] text-[var(--text-muted)] mb-4">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Living in Lima, campus life, visas, and health insurance.' : 'Alojamiento, vida universitaria en Lima, trámites de visa y seguro médico.' }}
                </p>
                <a href="{{ asset('documentos/Guia_del_alumno_de_intercambio.pdf') }}" target="_blank" rel="noopener noreferrer" class="btn-molinero text-xs w-full">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Download Handbook (PDF)' : 'Descargar Guía (PDF)' }}
                </a>
            </div>
        </div>
    </div>

    <!-- Carreras Profesionales -->
    <div>
        <h2 class="text-lg font-bold text-[var(--text-primary)] mb-4 text-center">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Our 12 Undergraduate Academic Programs' : 'Nuestras 12 Carreras Profesionales' }}
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 text-center text-xs">
            <div class="p-3 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Agronomy' : 'Agronomía' }}</div>
            <div class="p-3 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Animal Science' : 'Zootecnia' }}</div>
            <div class="p-3 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Food Industries & Engineering' : 'Industrias Alimentarias' }}</div>
            <div class="p-3 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Forestry Sciences' : 'Ciencias Forestales' }}</div>
            <div class="p-3 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Agricultural Engineering' : 'Ingeniería Agrícola' }}</div>
            <div class="p-3 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Environmental Engineering' : 'Ingeniería Ambiental' }}</div>
            <div class="p-3 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Biology' : 'Biología' }}</div>
            <div class="p-3 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Fisheries Engineering' : 'Pesquería' }}</div>
            <div class="p-3 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Economics' : 'Economía' }}</div>
            <div class="p-3 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Agribusiness Management' : 'Gestión Empresarial' }}</div>
            <div class="p-3 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Statistics & Computer Science' : 'Estadística e Informática' }}</div>
            <div class="p-3 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] font-medium">{{ ($currentLocale ?? 'es') === 'en' ? 'Meteorology' : 'Meteorología' }}</div>
        </div>
    </div>

    <!-- Requisitos para la Postulación -->
    <div class="card-molinero p-8">
        <h2 class="text-lg font-bold text-[var(--text-primary)] mb-4">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Application Dossier & Requirements' : 'Documentación y Requisitos para Postular' }}
        </h2>
        <ul class="text-xs sm:text-sm text-[var(--text-secondary)] space-y-2.5 list-disc pl-5 leading-relaxed">
            @if(($currentLocale ?? 'es') === 'en')
            <li>
                <strong>Official Nomination / Presentation Letter:</strong> Issued by the Director of International Relations of the applicant's home institution, addressed to the Director of OGI.
            </li>
            <li>
                <strong>OGI Application Form:</strong> Indicating the courses of interest (minimum 4, maximum 6 courses per semester).
            </li>
            <li>
                <strong>Official Academic Transcript:</strong> Certified grades of coursework completed at the home institution.
            </li>
            <li>
                <strong>Certificate of Class Standing:</strong> Certifying that the student belongs at least to the top third (tercio superior) of their class.
            </li>
            <li>
                <strong>Motivation Letter:</strong> Explaining academic reasons for choosing UNALM and studying in Peru.
            </li>
            <li>
                <strong>Passport Copy:</strong> Valid for at least 6 months after the planned end date of the exchange period.
            </li>
            <li>
                <strong>Comprehensive International Health Insurance:</strong> With coverage for repatriation of remains and inpatient medical expenses for the duration of the stay.
            </li>
            @else
            <li>
                <strong>Carta de Presentación / Nominación Oficial:</strong> Emitida por el Director de Relaciones Internacionales de la universidad de origen y dirigida a la Dirección de la OGI.
            </li>
            <li>
                <strong>Formato de Postulación OGI:</strong> Indicando las asignaturas de interés (mínimo 4, máximo 6 cursos por semestre).
            </li>
            <li>
                <strong>Historial Académico (Transcript):</strong> Certificado oficial de notas de las asignaturas cursadas en la universidad de origen.
            </li>
            <li>
                <strong>Constancia de Rendimiento Académico:</strong> Acreditando pertenecer como mínimo al tercio superior de su carrera.
            </li>
            <li>
                <strong>Carta de Motivación:</strong> Explicando las razones académicas para elegir la UNALM y el Perú.
            </li>
            <li>
                <strong>Copia de Pasaporte:</strong> Con vigencia mínima de 6 meses posteriores a la fecha de finalización del intercambio.
            </li>
            <li>
                <strong>Seguro Médico Internacional:</strong> Con cobertura de repatriación y gastos médicos por hospitalización durante toda la estancia.
            </li>
            @endif
        </ul>

        <div class="mt-6 pt-4 border-t border-[var(--border-color)] text-xs text-[var(--text-muted)] flex items-center justify-between">
            <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Inquiries and application submissions:' : 'Consultas y envío de expedientes:' }} <a href="mailto:ogi@lamolina.edu.pe" class="font-bold text-[#0F5132] dark:text-emerald-400 hover:underline">ogi@lamolina.edu.pe</a></span>
        </div>
    </div>
</section>
@endsection

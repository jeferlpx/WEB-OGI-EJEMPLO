@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'Pacific Alliance Scholarship Platform ?" UNALM' : 'Beca Alianza del Pacfico ?" UNALM')

@section('content')
<!-- Hero Header -->
<section class="bg-gradient-to-r from-emerald-950 via-[#0F5132] to-emerald-900 text-white py-12 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-wrap items-center gap-2 text-xs uppercase font-bold tracking-wider text-emerald-300 mb-2">
            <a href="{{ route('mobility.outgoing') }}" class="hover:underline flex items-center gap-1">
                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Outgoing Mobility' : 'Movilidad Saliente' }}</span>
            </a>
            <span>?</span>
            <span class="text-white">{{ ($currentLocale ?? 'es') === 'en' ? 'Pacific Alliance' : 'Alianza del Pacfico' }}</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-1 mb-3">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Pacific Alliance Student & Academic Mobility Grant' : 'Beca Alianza del Pacfico' }}
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed max-w-3xl">
            {{ ($currentLocale ?? 'es') === 'en'
                ? 'Regional integration grant offering fully funded academic exchanges in Chile, Colombia, and Mexico for undergraduate and graduate Molinero students.'
                : 'Mecanismo de integracin regional que financia movilidades acadǸmicas recprocas de pregrado y posgrado en universidades de Chile, Colombia y MǸxico.' }}
        </p>
    </div>
</section>

<!-- Subnavegacin de Movilidad Saliente -->
<div class="bg-[var(--bg-surface)] border-b border-[var(--border-color)] sticky top-20 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 overflow-x-auto py-2.5 text-xs font-semibold whitespace-nowrap scrollbar-none">
            <span class="text-[var(--text-muted)] uppercase tracking-wider text-[11px] pr-2 border-r border-[var(--border-color)]">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Outgoing Options:' : 'Opciones Salientes:' }}
            </span>
            <a href="{{ route('mobility.outgoing') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Study Abroad (Modalities)' : 'Estudia en el Extranjero' }}
            </a>
            <a href="{{ route('mobility.excellence') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                Excelencia AcadǸmica - BEAI
            </a>
            <a href="{{ route('mobility.pacific_alliance') }}" class="px-3 py-1.5 rounded-lg bg-[#0F5132] text-white">
                Beca Alianza del Pacfico
            </a>
            <a href="{{ route('mobility.summer_camp') }}" class="px-3 py-1.5 rounded-lg text-amber-700 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-950/40 transition-colors">
                Summer Camp UNALM
            </a>
        </div>
    </div>
</div>

<section class="py-12 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
    <!-- Descripcin del Mecanismo Regional -->
    <div class="card-molinero p-6 sm:p-8 space-y-6">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950/80 text-[#0F5132] dark:text-emerald-400 flex items-center justify-center flex-shrink-0 shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="space-y-4 text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                <h2 class="text-xl font-bold text-[var(--text-primary)]">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'The Pacific Alliance Student Mobility Platform' : 'Plataforma de Movilidad Estudiantil y AcadǸmica de la Alianza del Pacfico' }}
                </h2>
                <p>
                    {{ ($currentLocale ?? 'es') === 'en'
                        ? 'The Pacific Alliance is a regional integration mechanism established by Chile, Colombia, Mexico, and Peru. Under its "Student and Academic Mobility Platform", the four countries award 100 reciprocal full scholarships annually per country to strengthen relations among higher education institutions and build high-level human capital.'
                        : 'La Beca Alianza del Pacfico es un mecanismo de integracin regional conformado por los pases de Chile, Colombia, MǸxico y Perǧ, quienes establecieron el Programa de Becas ?Plataforma de movilidad estudiantil y acadǸmica de la Alianza del Pacfico?, cuyo propsito es contribuir al fortalecimiento de las relaciones entre instituciones de educacin superior y a la formacin de capital humano de alto nivel.' }}
                </p>
                <p>
                    {{ ($currentLocale ?? 'es') === 'en'
                        ? 'Through this framework, 100 annual scholarships per country are granted in reciprocal and equal conditions. The Universidad Nacional Agraria La Molina is an active member, enabling Molinero students to complete an academic semester with full monthly stipend, health insurance, and airfare in top universities in Chile, Colombia, and Mexico.'
                        : 'El programa otorga 100 becas anuales por pas de manera recproca y en tǸrminos de estricta igualdad. La UNALM forma parte activa del programa, brindando a los estudiantes molineros la oportunidad de realizar un intercambio con subvencin econmica mensual, pasajes internacionales y seguro mǸdico en instituciones de educacin superior lderes de Chile, Colombia y MǸxico.' }}
                </p>
            </div>
        </div>

        <!-- Pases Miembros -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
            <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800">
                <span class="text-2xl block mb-1">????</span>
                <span class="text-xs font-bold text-emerald-900 dark:text-emerald-200">Chile</span>
            </div>
            <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800">
                <span class="text-2xl block mb-1">????</span>
                <span class="text-xs font-bold text-emerald-900 dark:text-emerald-200">Colombia</span>
            </div>
            <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800">
                <span class="text-2xl block mb-1">????</span>
                <span class="text-xs font-bold text-emerald-900 dark:text-emerald-200">Mxico</span>
            </div>
            <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800">
                <span class="text-2xl block mb-1">????</span>
                <span class="text-xs font-bold text-emerald-900 dark:text-emerald-200">Per (Sede)</span>
            </div>
        </div>
    </div>

    <!-- Requisitos y Documentacin -->
    <div class="card-molinero p-6 sm:p-8 space-y-6">
        <h3 class="text-lg font-bold text-[var(--text-primary)] flex items-center gap-2">
            <svg class="w-5 h-5 text-[#0F5132] dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            {{ ($currentLocale ?? 'es') === 'en' ? 'Required Application Documentation' : 'Requisitos y Expediente de Postulacin' }}
        </h3>

        <ul class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs text-[var(--text-secondary)]">
            <li class="flex items-start gap-2.5 p-3 rounded-lg bg-[var(--bg-page)] border border-[var(--border-color)]">
                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span><strong>Carta de aceptacin definitiva</strong> de la Institucin de Educacin Superior (IES) de destino.</span>
            </li>
            <li class="flex items-start gap-2.5 p-3 rounded-lg bg-[var(--bg-page)] border border-[var(--border-color)]">
                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span><strong>Carta de postulacin</strong> oficial de la UNALM (tramitada a travǸs de la OGI).</span>
            </li>
            <li class="flex items-start gap-2.5 p-3 rounded-lg bg-[var(--bg-page)] border border-[var(--border-color)]">
                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span><strong>Certificado o constancia acadǸmica</strong> de matrcula vigente emitida por la UNALM.</span>
            </li>
            <li class="flex items-start gap-2.5 p-3 rounded-lg bg-[var(--bg-page)] border border-[var(--border-color)]">
                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span><strong>Certificado de percentil acadǸmico</strong> (pertenecer al tercio superior como mnimo).</span>
            </li>
            <li class="flex items-start gap-2.5 p-3 rounded-lg bg-[var(--bg-page)] border border-[var(--border-color)]">
                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span><strong>Carta de recomendacin acadǸmica</strong> y <strong>Carta de motivos</strong> del estudiante.</span>
            </li>
            <li class="flex items-start gap-2.5 p-3 rounded-lg bg-[var(--bg-page)] border border-[var(--border-color)]">
                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span><strong>Certificado mǸdico de salud fsica y mental</strong> expedido por centro de salud autorizado.</span>
            </li>
            <li class="flex items-start gap-2.5 p-3 rounded-lg bg-[var(--bg-page)] border border-[var(--border-color)]">
                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span><strong>Curriculum Vitae (CV)</strong> no documentado.</span>
            </li>
            <li class="flex items-start gap-2.5 p-3 rounded-lg bg-[var(--bg-page)] border border-[var(--border-color)]">
                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span><strong>Documento Nacional de Identidad (DNI)</strong> y <strong>Pasaporte</strong> vigente.</span>
            </li>
        </ul>

        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-4 rounded-xl bg-amber-50 dark:bg-amber-950/30 border border-amber-200 dark:border-amber-800 text-xs">
            <div class="text-[var(--text-secondary)]">
                <span class="font-bold text-amber-900 dark:text-amber-300 block mb-0.5">Calendario Referencial de Convocatoria:</span>
                <span>Lanzamiento regular entre los meses de <strong>Abril y Mayo</strong> de cada ao.</span>
            </div>
            <a href="{{ asset('documentos/Relacion_alumnos_Beca_Alianza_Pacfico.pdf') }}" target="_blank" rel="noopener noreferrer" class="btn-molinero text-xs whitespace-nowrap flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                <span>Descargar Nmina de Becarios (PDF)</span>
            </a>
        </div>
    </div>
</section>
@endsection


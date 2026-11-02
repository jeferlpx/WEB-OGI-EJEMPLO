@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'International Academic Excellence Program (BEAI) ?" UNALM' : 'Excelencia AcadǸmica Internacional (BEAI) ?" UNALM')

@section('content')
<!-- Hero Header -->
<section class="bg-gradient-to-r from-emerald-950 via-[#0F5132] to-emerald-900 text-white py-12 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-wrap items-center gap-2 text-xs uppercase font-bold tracking-wider text-emerald-300 mb-2">
            <a href="{{ route('mobility.outgoing') }}" class="hover:underline flex items-center gap-1">
                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Outgoing Mobility' : 'Movilidad Saliente' }}</span>
            </a>
            <span>?</span>
            <span class="text-white">BEAI</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-1 mb-3">
            {{ ($currentLocale ?? 'es') === 'en' ? 'International Academic Excellence Scholarship (BEAI)' : 'Excelencia AcadǸmica Internacional (BEAI)' }}
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed max-w-3xl">
            {{ ($currentLocale ?? 'es') === 'en'
                ? 'Flagship UNALM Rectorate program funding full semester academic mobility at top 100 global universities for outstanding undergraduate students.'
                : 'Programa emblemǭtico del Rectorado de la UNALM que financia un semestre acadǸmico en universidades lderes del mundo (Top 100 mundial) para los mejores estudiantes de pregrado.' }}
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
            <a href="{{ route('mobility.excellence') }}" class="px-3 py-1.5 rounded-lg bg-[#0F5132] text-white">
                Excelencia AcadǸmica - BEAI
            </a>
            <a href="{{ route('mobility.pacific_alliance') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                Beca Alianza del Pacfico
            </a>
            <a href="{{ route('mobility.summer_camp') }}" class="px-3 py-1.5 rounded-lg text-amber-700 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-950/40 transition-colors">
                Summer Camp UNALM
            </a>
        </div>
    </div>
</div>

<section class="py-12 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <!-- Presentacin y Fundamento Institucional -->
    <div class="card-molinero p-6 sm:p-8 space-y-6">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-950/80 text-amber-600 dark:text-amber-400 flex items-center justify-center flex-shrink-0 shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div class="space-y-4 text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                <h2 class="text-xl font-bold text-[var(--text-primary)]">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'The BEAI Program & Strategic Vision' : 'QuǸ es el Programa de Beca Excelencia AcadǸmica Internacional (BEAI)?' }}
                </h2>
                <p>
                    {{ ($currentLocale ?? 'es') === 'en'
                        ? 'The "Beca Excelencia AcadǸmica Internacional" (BEAI) is an initiative of the Rectorate of the Universidad Nacional Agraria La Molina. Conducted through an annual competitive call and financed with UNALM ordinary budget resources and extraordinary funds from the Ministry of Education (MINEDU), it embodies UNALM\'s internationalization commitment pursuant to Article 7 (subsection l) and Article 39 of the University Statute.'
                        : 'El Programa de ?Beca Excelencia AcadǸmica Internacional? (BEAI) es una iniciativa estratǸgica del Rectorado de la Universidad Nacional Agraria La Molina, de convocatoria anual y financiado con Recursos Ordinarios de la UNALM y fondos extraordinarios del MINEDU, en el marco de la bsqueda de la excelencia e internacionalizacin universitaria como lo sustenta el artculo 7, inciso l, y artculo 39 del Estatuto.' }}
                </p>
                <p>
                    {{ ($currentLocale ?? 'es') === 'en'
                        ? 'This prestigious program provides high-achieving undergraduate students with the opportunity to study a full academic semester at top-ranked international universities with active bilateral agreements. Selected institutions belong to the top 100 in global rankings (QS World University Rankings, ARWU Shanghai, and Times Higher Education).'
                        : 'Este programa busca proporcionar a los estudiantes de pregrado de ms alto rendimiento acadǸmico la oportunidad de estudiar un ciclo lectivo del correspondiente plan de estudios en universidades extranjeras de primer nivel internacional con las cuales la UNALM tiene convenios vigentes, fortaleciendo sus competencias tǸcnico-cientficas en instituciones del Top 100 mundial de los rankings QS, ARWU y THE.' }}
                </p>
            </div>
        </div>

        <!-- Hito Normativo: Convalidacin CU-UNALM -->
        <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-xs text-[var(--text-secondary)] space-y-2">
            <div class="flex items-center gap-2 font-bold text-emerald-900 dark:text-emerald-200">
                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Institutional Academic Validation Framework' : 'Resolucin N 0063-2018-CU-UNALM (Marco de Convalidacin)' }}</span>
            </div>
            <p>
                {{ ($currentLocale ?? 'es') === 'en'
                    ? 'Pursuant to Resolution No. 0063-2018-CU-UNALM, official guidelines are established ensuring that courses approved by Molinero students at foreign partner universities are fully validated toward their UNALM study plan.'
                    : 'A travǸs de la Resolucin N 0063-2018-CU-UNALM, el Consejo Universitario estableci los lineamientos oficiales para la convalidacin expedita y transparente de asignaturas aprobadas por nuestros becarios en universidades internacionales con convenio.' }}
            </p>
        </div>
    </div>

    <!-- Galera de Becarios Molineros -->
    <div class="space-y-4">
        <h3 class="text-lg font-bold text-[var(--text-primary)] flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
            {{ ($currentLocale ?? 'es') === 'en' ? 'BEAI Scholars Galleries & Presentations' : 'Galera de Becarios de Excelencia Internacional' }}
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="card-molinero overflow-hidden">
                <img src="{{ asset('imagenes/movilidad/saliente/excelencia_academica/Foto_BEAI_1.png') }}" alt="Estudiantes becarios BEAI UNALM" class="w-full h-48 object-cover hover:scale-105 transition-transform" />
                <div class="p-3 text-[11px] font-semibold text-[var(--text-muted)] text-center">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Scholars in Ceremony with Rectorate Authorities' : 'Becarios en Ceremonia Protocolar con el Rectorado' }}
                </div>
            </div>
            <div class="card-molinero overflow-hidden">
                <img src="{{ asset('imagenes/movilidad/saliente/excelencia_academica/Foto_BEAI_2.png') }}" alt="Grupo de beneficiarios BEAI" class="w-full h-48 object-cover hover:scale-105 transition-transform" />
                <div class="p-3 text-[11px] font-semibold text-[var(--text-muted)] text-center">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Molinero Scholars in Host Universities Abroad' : 'Estudiantes Molineros en Universidades Anfitrionas' }}
                </div>
            </div>
            <div class="card-molinero overflow-hidden">
                <img src="{{ asset('imagenes/movilidad/saliente/excelencia_academica/BEAI_2025.png') }}" alt="Promocin Becarios BEAI 2025" class="w-full h-48 object-cover hover:scale-105 transition-transform" />
                <div class="p-3 text-[11px] font-semibold text-[var(--text-muted)] text-center">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Official BEAI 2025 Delegation' : 'Promocin Oficial de Becarios BEAI 2025' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Directorio Histrico y Resoluciones Oficiales (PDFs 2020 - 2025) -->
    <div class="card-molinero p-6 sm:p-8 space-y-6">
        <div class="flex items-center justify-between border-b border-[var(--border-color)] pb-4">
            <div>
                <h3 class="text-lg font-bold text-[var(--text-primary)]">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Official Scholar Lists & Resolutions (PDF)' : 'Relacin Oficial de Estudiantes Becarios (PDFs)' }}
                </h3>
                <p class="text-xs text-[var(--text-muted)] mt-0.5">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Download verified rectoral lists and results per academic year' : 'Descarga las resoluciones y listas oficiales de beneficiarios por ao' }}
                </p>
            </div>
            <span class="px-2.5 py-1 rounded bg-amber-100 text-amber-900 dark:bg-amber-950 dark:text-amber-300 text-xs font-bold">
                2017 - 2025
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <!-- 2025 -->
            <a href="{{ asset('documentos/BEAI_2025.pdf') }}" target="_blank" rel="noopener noreferrer" class="p-4 rounded-xl border border-[var(--border-color)] hover:border-[#0F5132] bg-[var(--bg-page)] group transition-all flex items-center justify-between">
                <div>
                    <span class="block text-xs font-bold text-[var(--text-primary)] group-hover:text-[#0F5132] dark:group-hover:text-emerald-400">
                        {{ ($currentLocale ?? 'es') === 'en' ? 'BEAI Scholars 2025' : 'Relacin de Becarios 2025' }}
                    </span>
                    <span class="block text-[10px] text-[var(--text-muted)]">Resolucin Oficial ? PDF</span>
                </div>
                <svg class="w-6 h-6 text-red-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
            </a>

            <!-- 2024 -->
            <a href="{{ asset('documentos/Lista_BEAI_2024.pdf') }}" target="_blank" rel="noopener noreferrer" class="p-4 rounded-xl border border-[var(--border-color)] hover:border-[#0F5132] bg-[var(--bg-page)] group transition-all flex items-center justify-between">
                <div>
                    <span class="block text-xs font-bold text-[var(--text-primary)] group-hover:text-[#0F5132] dark:group-hover:text-emerald-400">
                        {{ ($currentLocale ?? 'es') === 'en' ? 'BEAI Scholars 2024' : 'Relacin de Becarios 2024' }}
                    </span>
                    <span class="block text-[10px] text-[var(--text-muted)]">Resolucin Oficial ? PDF</span>
                </div>
                <svg class="w-6 h-6 text-red-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
            </a>

            <!-- 2023 -->
            <a href="{{ asset('documentos/BEAI_2023.pdf') }}" target="_blank" rel="noopener noreferrer" class="p-4 rounded-xl border border-[var(--border-color)] hover:border-[#0F5132] bg-[var(--bg-page)] group transition-all flex items-center justify-between">
                <div>
                    <span class="block text-xs font-bold text-[var(--text-primary)] group-hover:text-[#0F5132] dark:group-hover:text-emerald-400">
                        {{ ($currentLocale ?? 'es') === 'en' ? 'BEAI Scholars 2023' : 'Relacin de Becarios 2023' }}
                    </span>
                    <span class="block text-[10px] text-[var(--text-muted)]">Resolucin Oficial ? PDF</span>
                </div>
                <svg class="w-6 h-6 text-red-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
            </a>

            <!-- 2022 -->
            <a href="{{ asset('documentos/BEAI_2022.pdf') }}" target="_blank" rel="noopener noreferrer" class="p-4 rounded-xl border border-[var(--border-color)] hover:border-[#0F5132] bg-[var(--bg-page)] group transition-all flex items-center justify-between">
                <div>
                    <span class="block text-xs font-bold text-[var(--text-primary)] group-hover:text-[#0F5132] dark:group-hover:text-emerald-400">
                        {{ ($currentLocale ?? 'es') === 'en' ? 'BEAI Scholars 2022' : 'Relacin de Becarios 2022' }}
                    </span>
                    <span class="block text-[10px] text-[var(--text-muted)]">Resolucin Oficial ? PDF</span>
                </div>
                <svg class="w-6 h-6 text-red-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
            </a>

            <!-- 2021 -->
            <a href="{{ asset('documentos/BEAI_2021.pdf') }}" target="_blank" rel="noopener noreferrer" class="p-4 rounded-xl border border-[var(--border-color)] hover:border-[#0F5132] bg-[var(--bg-page)] group transition-all flex items-center justify-between">
                <div>
                    <span class="block text-xs font-bold text-[var(--text-primary)] group-hover:text-[#0F5132] dark:group-hover:text-emerald-400">
                        {{ ($currentLocale ?? 'es') === 'en' ? 'BEAI Scholars 2021' : 'Relacin de Becarios 2021' }}
                    </span>
                    <span class="block text-[10px] text-[var(--text-muted)]">Resolucin Oficial ? PDF</span>
                </div>
                <svg class="w-6 h-6 text-red-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
            </a>

            <!-- 2020 -->
            <a href="{{ asset('documentos/BEAI_2020.pdf') }}" target="_blank" rel="noopener noreferrer" class="p-4 rounded-xl border border-[var(--border-color)] hover:border-[#0F5132] bg-[var(--bg-page)] group transition-all flex items-center justify-between">
                <div>
                    <span class="block text-xs font-bold text-[var(--text-primary)] group-hover:text-[#0F5132] dark:group-hover:text-emerald-400">
                        {{ ($currentLocale ?? 'es') === 'en' ? 'BEAI Scholars 2020' : 'Relacin de Becarios 2020' }}
                    </span>
                    <span class="block text-[10px] text-[var(--text-muted)]">Resolucin Oficial ? PDF</span>
                </div>
                <svg class="w-6 h-6 text-red-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
            </a>
        </div>
    </div>

    <!-- Pestaas Histricas de Becarios 2017, 2018 y 2019 -->
    <div class="card-molinero p-6 sm:p-8 space-y-6">
        <div class="flex items-center justify-between">
            <h3 class="text-base sm:text-lg font-bold text-[var(--text-primary)]">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Historical Beneficiary Registries (2017 - 2019)' : 'Nminas Histricas de Becarios (2017 - 2019)' }}
            </h3>
            <div class="flex items-center gap-1.5 bg-gray-100 dark:bg-gray-800 p-1 rounded-lg text-xs font-bold">
                <button type="button" onclick="switchYearTab('2019')" id="tabBtn2019" class="year-tab-btn px-3 py-1 rounded-md bg-white dark:bg-gray-700 shadow-sm text-[#0F5132] dark:text-emerald-400">2019</button>
                <button type="button" onclick="switchYearTab('2018')" id="tabBtn2018" class="year-tab-btn px-3 py-1 rounded-md text-[var(--text-muted)] hover:text-[var(--text-primary)]">2018</button>
                <button type="button" onclick="switchYearTab('2017')" id="tabBtn2017" class="year-tab-btn px-3 py-1 rounded-md text-[var(--text-muted)] hover:text-[var(--text-primary)]">2017</button>
            </div>
        </div>

        <!-- Tabla 2019 -->
        <div id="content2019" class="year-content overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-emerald-50 dark:bg-emerald-950/60 text-emerald-900 dark:text-emerald-200 uppercase font-bold text-[10px]">
                    <tr>
                        <th class="p-3">Pas</th>
                        <th class="p-3">Universidad de Destino</th>
                        <th class="p-3">Estudiante Becario</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)] text-[var(--text-secondary)]">
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">JAPON</td><td class="p-3 font-medium">Tokyo University of Marine Science and Technology</td><td class="p-3">Karla Nicol Loza Choque</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">JAPON</td><td class="p-3 font-medium">Tokyo University of Marine Science and Technology</td><td class="p-3">Diego Andre Otero Huaman</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">ALEMANIA</td><td class="p-3 font-medium">University of Applied Sciences (HTW Dresden)</td><td class="p-3">Jos Carlos Quispe Castro</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">AUSTRIA</td><td class="p-3 font-medium">University of Natural Resources and Life Sciences (BOKU)</td><td class="p-3">Alejandra Rocio Cruz Snchez</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">BRASIL</td><td class="p-3 font-medium">Universidade Federal de Santa Catarina (UFSC)</td><td class="p-3">Rodrigo Alonso Huarcaya Medina</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">CHILE</td><td class="p-3 font-medium">Universidad de Concepcin</td><td class="p-3">Gabriela Stefani Mendoza Romero</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">ESPAA</td><td class="p-3 font-medium">Universidad PolitǸcnica de Madrid</td><td class="p-3">Lucas Fabian Hurtado Cadenillas</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">EE.UU.</td><td class="p-3 font-medium">Iowa State University</td><td class="p-3">Milagros Elizabeth Valderrama Rivas</td></tr>
                </tbody>
            </table>
        </div>

        <!-- Tabla 2018 -->
        <div id="content2018" class="year-content hidden overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-emerald-50 dark:bg-emerald-950/60 text-emerald-900 dark:text-emerald-200 uppercase font-bold text-[10px]">
                    <tr>
                        <th class="p-3">Pas</th>
                        <th class="p-3">Universidad de Destino</th>
                        <th class="p-3">Estudiante Becario</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)] text-[var(--text-secondary)]">
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">EE.UU.</td><td class="p-3 font-medium">University of Central Oklahoma</td><td class="p-3">Armando Alexander Roman Mostacero</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">ALEMANIA</td><td class="p-3 font-medium">University of Hohenheim</td><td class="p-3">Claudia Ortega Vivanco</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">CHILE</td><td class="p-3 font-medium">Universidad de Concepcin</td><td class="p-3">Andrea Cristel Beltran Rosas</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">CHILE</td><td class="p-3 font-medium">Universidad de Concepcin</td><td class="p-3">Carla Pajares Gamarra</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">FRANCIA</td><td class="p-3 font-medium">INSA Toulouse</td><td class="p-3">Jean Pierre Mendoza Ramos</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">ESPAA</td><td class="p-3 font-medium">Universidad de Sevilla</td><td class="p-3">Lucia Patricia Chavez Diaz</td></tr>
                </tbody>
            </table>
        </div>

        <!-- Tabla 2017 -->
        <div id="content2017" class="year-content hidden overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-emerald-50 dark:bg-emerald-950/60 text-emerald-900 dark:text-emerald-200 uppercase font-bold text-[10px]">
                    <tr>
                        <th class="p-3">Pas</th>
                        <th class="p-3">Universidad de Destino</th>
                        <th class="p-3">Estudiante Becario</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)] text-[var(--text-secondary)]">
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">CHILE</td><td class="p-3 font-medium">Universidad de Concepcin</td><td class="p-3">Junior Alejandro Chiroque Chiroque</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">CHILE</td><td class="p-3 font-medium">Universidad de Concepcin</td><td class="p-3">Kevin Alfredo Sulca Gamboa</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">ESPAA</td><td class="p-3 font-medium">Universidad PolitǸcnica de Valencia</td><td class="p-3">Diana Carolina Ramos Gutierrez</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">BRASIL</td><td class="p-3 font-medium">Universidade Federal do Rio de Janeiro</td><td class="p-3">Victor Raul Perez Rodriguez</td></tr>
                    <tr><td class="p-3 font-semibold text-emerald-800 dark:text-emerald-400">COLOMBIA</td><td class="p-3 font-medium">Universidad Nacional de Colombia</td><td class="p-3">Silvia Nathaly Flores Benitez</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    function switchYearTab(year) {
        document.querySelectorAll('.year-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.year-tab-btn').forEach(btn => {
            btn.classList.remove('bg-white', 'dark:bg-gray-700', 'shadow-sm', 'text-[#0F5132]', 'dark:text-emerald-400');
            btn.classList.add('text-[var(--text-muted)]');
        });

        const activeCont = document.getElementById('content' + year);
        const activeBtn = document.getElementById('tabBtn' + year);
        if (activeCont) activeCont.classList.remove('hidden');
        if (activeBtn) {
            activeBtn.classList.add('bg-white', 'dark:bg-gray-700', 'shadow-sm', 'text-[#0F5132]', 'dark:text-emerald-400');
            activeBtn.classList.remove('text-[var(--text-muted)]');
        }
    }
</script>
@endsection


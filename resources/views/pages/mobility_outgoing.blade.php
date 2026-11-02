@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'Outgoing Mobility — Study Abroad | OGI UNALM' : 'Movilidad Saliente — Estudia en el Extranjero | OGI UNALM')

@section('content')
<section class="bg-gradient-to-r from-emerald-950 to-[#0F5132] text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs uppercase font-bold tracking-wider text-emerald-300">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Mobility for the Molinero Community' : 'Movilidad para la Comunidad Molinera' }}
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-1 mb-3">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Study Abroad' : 'Estudia en el Extranjero' }}
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed max-w-3xl">
            {{ ($currentLocale ?? 'es') === 'en'
                ? 'Live an international academic experience at world-leading partner universities, validate courses toward your graduation, and expand your scientific and professional perspective.'
                : 'Vive una experiencia académica internacional en las mejores universidades del mundo, convalida cursos en tu carrera y amplía tu perspectiva científica y profesional.' }}
        </p>
    </div>
</section>

<!-- Subnavegación de Movilidad Saliente -->
<div class="bg-[var(--bg-surface)] border-b border-[var(--border-color)] sticky top-20 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 overflow-x-auto py-2.5 text-xs font-semibold whitespace-nowrap scrollbar-none">
            <span class="text-[var(--text-muted)] uppercase tracking-wider text-[11px] pr-2 border-r border-[var(--border-color)]">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Outgoing Options:' : 'Opciones Salientes:' }}
            </span>
            <a href="{{ route('mobility.outgoing') }}" class="px-3 py-1.5 rounded-lg bg-[#0F5132] text-white">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Study Abroad (Modalities)' : 'Estudia en el Extranjero' }}
            </a>
            <a href="{{ route('mobility.excellence') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                Excelencia Académica - BEAI
            </a>
            <a href="{{ route('mobility.pacific_alliance') }}" class="px-3 py-1.5 rounded-lg text-[var(--text-secondary)] hover:bg-emerald-50 dark:hover:bg-emerald-950/60 hover:text-[#0F5132] dark:hover:text-emerald-400 transition-colors">
                Beca Alianza del Pacífico
            </a>
            <a href="{{ route('mobility.summer_camp') }}" class="px-3 py-1.5 rounded-lg text-amber-700 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-950/40 transition-colors">
                Summer Camp UNALM
            </a>
        </div>
    </div>
</div>

<section class="py-12 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <!-- Dos Modalidades de Intercambio -->
    <div>
        <h2 class="text-xl font-bold text-[var(--text-primary)] mb-6 text-center">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Options for Completing an Academic Exchange' : 'Modalidades para Realizar un Intercambio Estudiantil' }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Modalidad A: Recursos Propios -->
            <div class="card-molinero p-8 border-t-4 border-t-emerald-600">
                <div class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-950 text-[#0F5132] dark:text-emerald-400 font-bold flex items-center justify-center mb-4">
                    A
                </div>
                <h3 class="text-lg font-bold text-[var(--text-primary)] mb-3">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Self-Funded Exchange' : 'Con Recursos Propios' }}
                </h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed mb-4">
                    {!! ($currentLocale ?? 'es') === 'en'
                        ? 'The student covers personal living and accommodation expenses abroad while benefiting from a <strong>full tuition waiver</strong> at the host university through UNALM’s bilateral agreements.'
                        : 'El estudiante asume sus gastos personales de estancia y sostenimiento en el extranjero, beneficiándose de la <strong>exoneración de costos académicos</strong> en la universidad de destino gracias a los convenios bilaterales de la UNALM.' !!}
                </p>
                <div class="bg-gray-50 dark:bg-emerald-950/20 p-4 rounded-lg border border-[var(--border-color)]">
                    <h4 class="text-xs font-bold text-[var(--text-primary)] mb-2">{{ ($currentLocale ?? 'es') === 'en' ? 'Key Requirements:' : 'Requisitos Clave:' }}</h4>
                    <ul class="text-xs text-[var(--text-secondary)] space-y-1.5 list-disc pl-4">
                        <li>{{ ($currentLocale ?? 'es') === 'en' ? 'Financial solvency for airfare, accommodation, and international insurance.' : 'Contar con solvencia económica para pasajes, vivienda y seguro.' }}</li>
                        <li>{{ ($currentLocale ?? 'es') === 'en' ? 'Select a destination university with an active agreement with UNALM.' : 'Elegir una universidad de destino con convenio vigente con la UNALM.' }}</li>
                        <li>{{ ($currentLocale ?? 'es') === 'en' ? 'Request application requirements and deadlines from OGI in advance.' : 'Solicitar oportunamente requisitos y fechas de postulación en la OGI.' }}</li>
                        <li>{{ ($currentLocale ?? 'es') === 'en' ? 'Valid passport and student visa if required by the destination country.' : 'Contar con pasaporte vigente y gestionar visa si el país lo requiere.' }}</li>
                        <li>{{ ($currentLocale ?? 'es') === 'en' ? 'Approval of the course validation plan by your Faculty Deanery.' : 'Aprobación del plan de convalidación académica por su Facultad.' }}</li>
                    </ul>
                </div>
            </div>

            <!-- Modalidad B: Mediante Beca -->
            <div class="card-molinero p-8 border-t-4 border-t-[#D4AF37]">
                <div class="w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-950 text-amber-600 dark:text-amber-400 font-bold flex items-center justify-center mb-4">
                    B
                </div>
                <h3 class="text-lg font-bold text-[var(--text-primary)] mb-3">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Scholarship-Funded Exchange' : 'Mediante una Beca' }}
                </h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed mb-4">
                    {!! ($currentLocale ?? 'es') === 'en'
                        ? 'The student applies to competitive calls providing full or partial living allowances (Pacific Alliance, Santander, BEAI, etc.).'
                        : 'El estudiante postula a convocatorias competitivas que otorgan financiamiento integral o parcial de sostenimiento (Alianza del Pacífico, Santander, BEAI, etc.).' !!}
                </p>
                <div class="bg-gray-50 dark:bg-emerald-950/20 p-4 rounded-lg border border-[var(--border-color)]">
                    <h4 class="text-xs font-bold text-[var(--text-primary)] mb-2">{{ ($currentLocale ?? 'es') === 'en' ? 'Key Requirements:' : 'Requisitos Clave:' }}</h4>
                    <ul class="text-xs text-[var(--text-secondary)] space-y-1.5 list-disc pl-4">
                        <li>{{ ($currentLocale ?? 'es') === 'en' ? 'Rank at least in the upper third (tercio superior) of your faculty.' : 'Pertenecer como mínimo al tercio superior de su facultad.' }}</li>
                        <li>{{ ($currentLocale ?? 'es') === 'en' ? 'Have completed at least 50% of your curriculum credit hours.' : 'Haber aprobado al menos el 50% de los créditos del plan de estudios.' }}</li>
                        <li>{{ ($currentLocale ?? 'es') === 'en' ? 'Comply with specific guidelines and deadlines set by the funding agency.' : 'Cumplir con las fechas y requisitos específicos del organismo cooperante.' }}</li>
                        <li>{{ ($currentLocale ?? 'es') === 'en' ? 'Participate in OGI induction and briefing sessions.' : 'Participar en las sesiones de inducción y asesoría de la OGI.' }}</li>
                        <li>{{ ($currentLocale ?? 'es') === 'en' ? 'Submit an academic report upon return from the exchange semester.' : 'Presentar informe académico al retorno del intercambio.' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Guía Paso a Paso -->
    <div class="card-molinero p-8">
        <h2 class="text-lg font-bold text-[var(--text-primary)] mb-6 text-center">
            {{ ($currentLocale ?? 'es') === 'en' ? 'International Exchange Application Roadmap' : 'Ruta de Postulación a un Intercambio Internacional' }}
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="space-y-2">
                <span class="w-8 h-8 rounded-full bg-[#0F5132] text-white flex items-center justify-center font-bold text-xs mx-auto">1</span>
                <h4 class="text-xs font-bold text-[var(--text-primary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Information' : 'Información' }}</h4>
                <p class="text-[11px] text-[var(--text-muted)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Review active agreements and compatible academic programs, and check guidelines at OGI.' : 'Revisa convenios vigentes, programas académicos compatibles y consulta las bases en la OGI.' }}</p>
            </div>
            <div class="space-y-2">
                <span class="w-8 h-8 rounded-full bg-[#0F5132] text-white flex items-center justify-center font-bold text-xs mx-auto">2</span>
                <h4 class="text-xs font-bold text-[var(--text-primary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Course Plan' : 'Plan de Cursos' }}</h4>
                <p class="text-[11px] text-[var(--text-muted)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Draft your proposed course load and obtain preliminary approval from your Faculty.' : 'Elabora tu propuesta de asignaturas a cursar y solicita la aprobación previa en tu Facultad.' }}</p>
            </div>
            <div class="space-y-2">
                <span class="w-8 h-8 rounded-full bg-[#0F5132] text-white flex items-center justify-center font-bold text-xs mx-auto">3</span>
                <h4 class="text-xs font-bold text-[var(--text-primary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'OGI Nomination' : 'Nominación OGI' }}</h4>
                <p class="text-[11px] text-[var(--text-muted)]">{{ ($currentLocale ?? 'es') === 'en' ? 'OGI reviews your application and issues the official nomination letter to the partner university.' : 'La OGI evalúa tu expediente y emite la carta oficial de nominación ante la universidad socia.' }}</p>
            </div>
            <div class="space-y-2">
                <span class="w-8 h-8 rounded-full bg-[#0F5132] text-white flex items-center justify-center font-bold text-xs mx-auto">4</span>
                <h4 class="text-xs font-bold text-[var(--text-primary)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Acceptance & Travel' : 'Aceptación y Viaje' }}</h4>
                <p class="text-[11px] text-[var(--text-muted)]">{{ ($currentLocale ?? 'es') === 'en' ? 'Upon receiving the acceptance letter, arrange passport, student visa, insurance, and enrollment.' : 'Al recibir la carta de aceptación, gestiona pasaporte, visa de estudiante, seguro y matrícula.' }}</p>
            </div>
        </div>
    </div>

    <!-- Preguntas Frecuentes -->
    @if($faqs->count() > 0)
    <div>
        <h2 class="text-lg font-bold text-[var(--text-primary)] mb-4">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Frequently Asked Questions for Outgoing Students' : 'Preguntas Frecuentes de Estudiantes Salientes' }}
        </h2>
        <div class="space-y-3">
            @foreach($faqs as $f)
            <div class="card-molinero p-4">
                <h3 class="text-xs font-bold text-[var(--text-primary)] mb-1">
                    {{ ($currentLocale ?? 'es') === 'en' && $f->question_en ? $f->question_en : $f->question }}
                </h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    {{ ($currentLocale ?? 'es') === 'en' && $f->answer_en ? $f->answer_en : $f->answer }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</section>
@endsection

@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'Mission, Vision & Values — OGI UNALM' : 'Misión, Visión y Valores — OGI UNALM')

@section('content')
<!-- Cabecera Institucional Dinámica -->
<section class="bg-gradient-to-r from-emerald-950 via-[#0F5132] to-[#0A3622] text-white py-14 border-b border-emerald-900/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs uppercase font-bold tracking-wider text-emerald-300">
            {{ \App\Models\SiteSetting::get('mv_badge', 'Marco Estratégico', $currentLocale ?? 'es') }}
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white mt-1">
            {{ \App\Models\SiteSetting::get('mv_title', 'Misión, Visión y Valores', $currentLocale ?? 'es') }}
        </h1>
    </div>
</section>

<section class="py-14 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
    <!-- Visión y Misión Administrables -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="card-molinero p-8 sm:p-9 border-t-4 border-t-[#0F5132] shadow-md">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center text-[#0F5132] dark:text-emerald-400 mb-4 shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </div>
            <h2 class="text-xl sm:text-2xl font-extrabold text-[var(--text-primary)] mb-3">
                {{ \App\Models\SiteSetting::get('mv_vision_title', 'Visión Institucional', $currentLocale ?? 'es') }}
            </h2>
            <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                {{ \App\Models\SiteSetting::get('mv_vision_text', 'Posicionar estratégicamente a la UNALM dentro del versátil contexto internacional y ser el centro gestor de los ejes de la internacionalización universitaria: movilidad y cooperación en educación, interculturalidad, investigación y extensión, en las áreas de ciencias agrarias, pecuarias, pesqueras, productivas, económicas, alimentación, sostenibilidad ambiental e innovación.', $currentLocale ?? 'es') }}
            </p>
        </div>

        <div class="card-molinero p-8 sm:p-9 border-t-4 border-t-[#D4AF37] shadow-md">
            <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-950/60 flex items-center justify-center text-amber-600 dark:text-amber-400 mb-4 shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h2 class="text-xl sm:text-2xl font-extrabold text-[var(--text-primary)] mb-3">
                {{ \App\Models\SiteSetting::get('mv_mission_title', 'Misión Institucional', $currentLocale ?? 'es') }}
            </h2>
            <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                {{ \App\Models\SiteSetting::get('mv_mission_text', 'Incrementar el número de vínculos nacionales e internacionales que conlleven a programas de cooperación internacional multidisciplinarios, colaborando con los docentes, alumnos y egresados de la UNALM en los procesos necesarios para su inserción en los referidos programas.', $currentLocale ?? 'es') }}
            </p>
        </div>
    </div>

    <!-- Valores Institucionales Administrables -->
    <div class="card-molinero p-8 sm:p-10 shadow-md">
        <h2 class="text-xl sm:text-2xl font-extrabold text-[var(--text-primary)] mb-8 text-center">
            {{ \App\Models\SiteSetting::get('mv_values_title', 'Nuestros Valores Molineros', $currentLocale ?? 'es') }}
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="p-5 rounded-2xl bg-gray-50 dark:bg-emerald-950/20 border border-[var(--border-color)]">
                <span class="text-3xl mb-3 block">🤝</span>
                <h3 class="text-sm font-bold text-[var(--text-primary)]">
                    {{ \App\Models\SiteSetting::get('mv_val1_title', 'Compromiso', $currentLocale ?? 'es') }}
                </h3>
                <p class="text-xs text-[var(--text-muted)] mt-1.5 leading-relaxed">
                    {{ \App\Models\SiteSetting::get('mv_val1_desc', 'Dedicación con la excelencia académica y los intereses institucionales.', $currentLocale ?? 'es') }}
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-gray-50 dark:bg-emerald-950/20 border border-[var(--border-color)]">
                <span class="text-3xl mb-3 block">🌱</span>
                <h3 class="text-sm font-bold text-[var(--text-primary)]">
                    {{ \App\Models\SiteSetting::get('mv_val2_title', 'Identificación', $currentLocale ?? 'es') }}
                </h3>
                <p class="text-xs text-[var(--text-muted)] mt-1.5 leading-relaxed">
                    {{ \App\Models\SiteSetting::get('mv_val2_desc', 'Orgullo por nuestra tradición agrícola, científica y ambiental.', $currentLocale ?? 'es') }}
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-gray-50 dark:bg-emerald-950/20 border border-[var(--border-color)]">
                <span class="text-3xl mb-3 block">⚖️</span>
                <h3 class="text-sm font-bold text-[var(--text-primary)]">
                    {{ \App\Models\SiteSetting::get('mv_val3_title', 'Responsabilidad', $currentLocale ?? 'es') }}
                </h3>
                <p class="text-xs text-[var(--text-muted)] mt-1.5 leading-relaxed">
                    {{ \App\Models\SiteSetting::get('mv_val3_desc', 'Transparencia, rigor técnico y cumplimiento normativo en cada acuerdo.', $currentLocale ?? 'es') }}
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-gray-50 dark:bg-emerald-950/20 border border-[var(--border-color)]">
                <span class="text-3xl mb-3 block">💬</span>
                <h3 class="text-sm font-bold text-[var(--text-primary)]">
                    {{ \App\Models\SiteSetting::get('mv_val4_title', 'Comunicación', $currentLocale ?? 'es') }}
                </h3>
                <p class="text-xs text-[var(--text-muted)] mt-1.5 leading-relaxed">
                    {{ \App\Models\SiteSetting::get('mv_val4_desc', 'Diálogo constructivo y oportuno con estudiantes, docentes y aliados globales.', $currentLocale ?? 'es') }}
                </p>
            </div>
        </div>
    </div>
</section>
@endsection

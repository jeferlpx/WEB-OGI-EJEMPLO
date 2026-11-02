@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'Official Contact — OGI UNALM' : 'Contacto Oficial — OGI UNALM')

@section('content')
<!-- Cabecera Institucional Dinámica -->
<section class="bg-gradient-to-r from-emerald-950 via-[#0F5132] to-[#0A3622] text-white py-14 border-b border-emerald-900/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs uppercase font-bold tracking-wider text-emerald-300">
            {{ \App\Models\SiteSetting::get('contact_badge', 'Canales de Atención', $currentLocale ?? 'es') }}
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white mt-1 mb-3">
            {{ \App\Models\SiteSetting::get('contact_title', 'Contacto Institucional', $currentLocale ?? 'es') }}
        </h1>
        <p class="text-xs sm:text-base text-emerald-100/95 leading-relaxed max-w-3xl">
            {{ \App\Models\SiteSetting::get('contact_subtitle', 'Comunícate con nuestro equipo directivo y coordinadores para consultas sobre convenios, movilidad académica y oportunidades de becas.', $currentLocale ?? 'es') }}
        </p>
    </div>
</section>

<section class="py-16 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
        <!-- Canales Oficiales Administrables -->
        <div class="card-molinero p-8 space-y-6 shadow-md">
            <h2 class="text-lg sm:text-xl font-extrabold text-[var(--text-primary)] border-b border-[var(--border-color)] pb-3">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Office & Contact Information' : 'Información de Atención' }}
            </h2>

            <div class="space-y-5 text-xs sm:text-sm text-[var(--text-secondary)]">
                <!-- Ubicación Física -->
                <div class="flex items-start gap-3.5">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-[#0F5132] dark:text-emerald-400 flex items-center justify-center flex-shrink-0 shadow-sm mt-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <strong class="block text-xs uppercase font-bold text-[var(--text-primary)] mb-0.5">{{ ($currentLocale ?? 'es') === 'en' ? 'Physical Location:' : 'Ubicación Física:' }}</strong>
                        <span class="leading-relaxed">{!! nl2br(e(\App\Models\SiteSetting::get('contact_address', "Av. La Molina s/n, La Molina — Lima, Perú\nCampus Universitario UNALM (Edificio del Rectorado, 2.° Piso)", $currentLocale ?? 'es'))) !!}</span>
                    </div>
                </div>

                <!-- Correo Electrónico -->
                <div class="flex items-start gap-3.5">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-[#0F5132] dark:text-emerald-400 flex items-center justify-center flex-shrink-0 shadow-sm mt-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <strong class="block text-xs uppercase font-bold text-[var(--text-primary)] mb-0.5">{{ ($currentLocale ?? 'es') === 'en' ? 'Official Email Address:' : 'Correo Electrónico Oficial:' }}</strong>
                        @php $contactEmail = \App\Models\SiteSetting::get('contact_email', 'ogi@lamolina.edu.pe', $currentLocale ?? 'es'); @endphp
                        <a href="mailto:{{ $contactEmail }}" class="text-[#0F5132] dark:text-emerald-400 font-bold hover:underline">{{ $contactEmail }}</a>
                    </div>
                </div>

                <!-- Teléfono / Central -->
                <div class="flex items-start gap-3.5">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-[#0F5132] dark:text-emerald-400 flex items-center justify-center flex-shrink-0 shadow-sm mt-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <strong class="block text-xs uppercase font-bold text-[var(--text-primary)] mb-0.5">{{ ($currentLocale ?? 'es') === 'en' ? 'Telephone / Extensions:' : 'Central Telefónica:' }}</strong>
                        <span>{{ \App\Models\SiteSetting::get('contact_phone', '(01) 614-7800 Anexos 212 (Dirección), 215 (Movilidad), 218 (Convenios)', $currentLocale ?? 'es') }}</span>
                    </div>
                </div>

                <!-- Horario de Atención -->
                <div class="flex items-start gap-3.5">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-[#0F5132] dark:text-emerald-400 flex items-center justify-center flex-shrink-0 shadow-sm mt-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <strong class="block text-xs uppercase font-bold text-[var(--text-primary)] mb-0.5">{{ ($currentLocale ?? 'es') === 'en' ? 'In-Person Office Hours:' : 'Horario de Atención Presencial:' }}</strong>
                        <span>{{ \App\Models\SiteSetting::get('contact_hours', 'Lunes a Viernes de 8:00 a.m. a 4:00 p.m.', $currentLocale ?? 'es') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orientación para Nuevas Propuestas de Convenio Administrable -->
        <div class="card-molinero p-8 flex flex-col justify-between shadow-md">
            <div>
                <h2 class="text-lg sm:text-xl font-extrabold text-[var(--text-primary)] border-b border-[var(--border-color)] pb-3 mb-4">
                    {{ \App\Models\SiteSetting::get('contact_proposal_title', 'Para Socios e Instituciones Extranjeras', $currentLocale ?? 'es') }}
                </h2>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed mb-4">
                    {{ \App\Models\SiteSetting::get('contact_proposal_desc', 'Si representa a una universidad, organismo de investigación o entidad internacional y desea iniciar el trámite para suscribir un nuevo Convenio Marco o Convenio Específico de Movilidad con la UNALM:', $currentLocale ?? 'es') }}
                </p>
                <div class="bg-gray-50 dark:bg-emerald-950/20 p-5 rounded-xl border border-[var(--border-color)] space-y-2.5 text-xs text-[var(--text-secondary)]">
                    <p class="flex items-start gap-2">
                        <span class="w-4 h-4 rounded-full bg-emerald-100 dark:bg-emerald-950 text-[#0F5132] dark:text-emerald-400 font-bold flex items-center justify-center flex-shrink-0 text-[10px]">1</span>
                        <span>{{ \App\Models\SiteSetting::get('contact_step1', 'Remita una carta de intención formal firmada por la autoridad competente de su institución.', $currentLocale ?? 'es') }}</span>
                    </p>
                    <p class="flex items-start gap-2">
                        <span class="w-4 h-4 rounded-full bg-emerald-100 dark:bg-emerald-950 text-[#0F5132] dark:text-emerald-400 font-bold flex items-center justify-center flex-shrink-0 text-[10px]">2</span>
                        <span>{{ \App\Models\SiteSetting::get('contact_step2', 'Adjunte la propuesta preliminar de convenio y señale las facultades o carreras de mutuo interés.', $currentLocale ?? 'es') }}</span>
                    </p>
                    <p class="flex items-start gap-2">
                        <span class="w-4 h-4 rounded-full bg-emerald-100 dark:bg-emerald-950 text-[#0F5132] dark:text-emerald-400 font-bold flex items-center justify-center flex-shrink-0 text-[10px]">3</span>
                        <span>{{ \App\Models\SiteSetting::get('contact_step3', 'Envíe la documentación digital al correo institucional: ogi@lamolina.edu.pe.', $currentLocale ?? 'es') }}</span>
                    </p>
                </div>
            </div>

            <div class="pt-6">
                <a href="mailto:{{ $contactEmail }}?subject=Propuesta%20de%20Convenio%20Institucional" class="btn-molinero text-xs py-3 w-full text-center flex items-center justify-center gap-2 shadow-sm hover:shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Submit Collaboration Proposal' : 'Enviar Propuesta de Colaboración' }}</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

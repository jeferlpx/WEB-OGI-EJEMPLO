@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'Management Team — OGI UNALM' : 'Equipo de Gestión — OGI UNALM')

@section('content')
<!-- Cabecera Institucional Dinámica -->
<section class="bg-gradient-to-r from-emerald-950 via-[#0F5132] to-[#0A3622] text-white py-14 border-b border-emerald-900/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs uppercase font-bold tracking-wider text-emerald-300">
            {{ \App\Models\SiteSetting::get('team_badge', 'Directorio Institucional', $currentLocale ?? 'es') }}
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white mt-1 mb-3">
            {{ \App\Models\SiteSetting::get('team_title', 'Equipo de Gestión OGI', $currentLocale ?? 'es') }}
        </h1>
        <p class="text-xs sm:text-base text-emerald-100/95 leading-relaxed max-w-3xl">
            {{ \App\Models\SiteSetting::get('team_subtitle', 'Profesionales comprometidos con el acompañamiento y servicio a la comunidad universitaria en temas de movilidad, becas y convenios.', $currentLocale ?? 'es') }}
        </p>
    </div>
</section>

<!-- Cuadrícula con Recuadros Grandes para el Equipo de Gestión -->
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @php
        $deptMap = [
            'Dirección General' => 'General Directorate',
            'Movilidad Estudiantil y Docente' => 'Student & Faculty Mobility',
            'Convenios y Redes' => 'Agreements & Networks',
            'Cooperación Global' => 'Global Cooperation',
            'Gestión Interinstitucional' => 'Inter-institutional Management',
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
        @foreach($team as $member)
        @php
            $rawDept = $member->department ?: 'Gestión Interinstitucional';
            $displayDept = ($currentLocale ?? 'es') === 'en' ? ($deptMap[$rawDept] ?? $rawDept) : $rawDept;
        @endphp
        <div class="card-molinero p-6 sm:p-7 flex flex-col sm:flex-row gap-6 justify-between items-start group hover:border-emerald-500/60 transition-all duration-300">
            <!-- Recuadro Grande de Retrato -->
            <div class="w-full sm:w-48 h-60 sm:h-64 rounded-2xl overflow-hidden bg-gradient-to-br from-emerald-900 to-[#0A3622] flex-shrink-0 flex items-center justify-center border-2 border-emerald-600/40 shadow-lg relative group-hover:scale-[1.02] transition-transform duration-300">
                @if($member->photo_path)
                <img src="{{ asset($member->photo_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover object-top" />
                @else
                <img src="{{ asset(($currentLocale ?? 'es') === 'en' ? 'imagenes/placeholder_referencia_en.svg' : 'imagenes/placeholder_referencia.svg') }}" alt="Fotografía institucional pendiente" class="w-full h-full object-cover" />
                @endif
                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent p-2 text-center sm:hidden">
                    <span class="text-xs text-white font-bold">{{ $member->name }}</span>
                </div>
            </div>

            <!-- Información Profesional Detallada -->
            <div class="flex-1 flex flex-col justify-between h-full min-w-0">
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 block mb-1">
                        {{ $displayDept }}
                    </span>
                    <h2 class="text-lg sm:text-xl font-extrabold text-[var(--text-primary)] leading-tight mb-1">
                        {{ $member->name }}
                    </h2>
                    <p class="text-xs sm:text-sm font-semibold text-[#0F5132] dark:text-emerald-300 mb-4">
                        {{ $member->trans('role_title') }}
                    </p>

                    @if($member->bio)
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed mb-5 line-clamp-4">
                        {{ $member->trans('bio') }}
                    </p>
                    @endif
                </div>

                <!-- Canales de Contacto Directo -->
                <div class="pt-4 border-t border-[var(--border-color)] space-y-2 text-xs text-[var(--text-secondary)]">
                    @if($member->email)
                    <div class="flex items-center gap-2.5 truncate">
                        <div class="w-6 h-6 rounded-md bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center text-[#0F5132] dark:text-emerald-400 flex-shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <a href="mailto:{{ $member->email }}" class="text-emerald-700 dark:text-emerald-400 font-semibold hover:underline truncate">{{ $member->email }}</a>
                    </div>
                    @endif

                    @if($member->phone)
                    <div class="flex items-center gap-2.5">
                        <div class="w-6 h-6 rounded-md bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center text-[#0F5132] dark:text-emerald-400 flex-shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <span class="font-medium text-[var(--text-primary)]">{{ ($currentLocale ?? 'es') === 'en' ? str_replace('Anexo', 'Ext.', $member->phone) : $member->phone }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

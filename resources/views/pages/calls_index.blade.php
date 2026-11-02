@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'Scholarships & Calls — OGI UNALM' : 'Becas y Convocatorias — OGI UNALM')

@section('content')
@php
    $audMap = [
        'estudiantes' => 'Undergraduate & Graduate Students',
        'docentes' => 'Faculty & Teaching Staff',
        'investigadores' => 'Researchers',
        'comunidad_molinera' => 'Entire UNALM Community',
    ];
    $callTypeMap = [
        'movilidad' => 'Academic Mobility',
        'beca' => 'Scholarship',
        'investigacion' => 'Research Project',
        'capacitacion' => 'Technical Training',
    ];
@endphp

<section class="bg-gradient-to-r from-emerald-950 to-[#0F5132] text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs uppercase font-bold tracking-wider text-emerald-300">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Funding & Mobility Opportunities' : 'Oportunidades de Financiamiento y Movilidad' }}
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-1 mb-3">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Scholarships & Calls' : 'Becas y Convocatorias' }}
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed max-w-3xl">
            {{ ($currentLocale ?? 'es') === 'en'
                ? 'Open calls and national and international scholarship programs for UNALM undergraduate, graduate students, researchers, and faculty.'
                : 'Convocatorias abiertas y programas de becas nacionales e internacionales para estudiantes de pregrado, posgrado y docentes de la UNALM.' }}
        </p>
    </div>
</section>

<section class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($calls as $call)
        <div class="card-molinero flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="badge-status badge-{{ $call->status === 'abierta' ? 'vigente' : 'vencido' }}">
                        {{ ($currentLocale ?? 'es') === 'en' ? ($call->status === 'abierta' ? 'Open Call' : 'Closed') : ucfirst($call->status) }}
                    </span>
                    @if($call->deadline_date)
                    <span class="text-[11px] text-[var(--text-muted)] font-medium">
                        {{ ($currentLocale ?? 'es') === 'en' ? 'Deadline: ' . $call->deadline_date->format('M d, Y') : 'Cierre: ' . $call->deadline_date->format('d/m/Y') }}
                    </span>
                    @endif
                </div>

                <h2 class="text-base font-bold text-[var(--text-primary)] mb-2 line-clamp-2">
                    <a href="{{ route('calls.show', $call->slug) }}" class="hover:text-[#0F5132] dark:hover:text-emerald-400">
                        {{ $call->trans('title') }}
                    </a>
                </h2>

                <p class="text-xs text-[var(--text-secondary)] line-clamp-3 mb-4">
                    {{ $call->trans('summary') }}
                </p>

                <div class="text-[11px] text-[var(--text-muted)] space-y-1 mb-4">
                    <div>
                        {{ ($currentLocale ?? 'es') === 'en' ? 'Audience:' : 'Público:' }}
                        <strong class="text-[var(--text-primary)]">
                            {{ ($currentLocale ?? 'es') === 'en' ? ($audMap[strtolower($call->target_audience)] ?? ucfirst(str_replace('_', ' ', $call->target_audience))) : ucfirst(str_replace('_', ' ', $call->target_audience)) }}
                        </strong>
                    </div>
                    <div>
                        {{ ($currentLocale ?? 'es') === 'en' ? 'Type:' : 'Tipo:' }}
                        <strong class="text-[var(--text-primary)]">
                            {{ ($currentLocale ?? 'es') === 'en' ? ($callTypeMap[strtolower($call->call_type)] ?? ucfirst($call->call_type)) : ucfirst($call->call_type) }}
                        </strong>
                    </div>
                </div>
            </div>

            <a href="{{ route('calls.show', $call->slug) }}" class="btn-molinero text-xs text-center w-full">
                {{ ($currentLocale ?? 'es') === 'en' ? 'View Details & Requirements' : 'Ver Detalles y Requisitos' }}
            </a>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $calls->links() }}
    </div>
</section>
@endsection

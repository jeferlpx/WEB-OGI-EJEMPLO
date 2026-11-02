@extends('layouts.app')

@section('title', $call->trans('title'))

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
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 mb-3">
            <a href="{{ route('calls.index') }}" class="text-xs text-emerald-300 hover:text-white flex items-center gap-1">
                {{ ($currentLocale ?? 'es') === 'en' ? '← Back to Calls & Scholarships' : '← Volver a Convocatorias' }}
            </a>
            <span class="text-emerald-500">•</span>
            <span class="badge-status badge-{{ $call->status === 'abierta' ? 'vigente' : 'vencido' }} text-[10px]">
                {{ ($currentLocale ?? 'es') === 'en' ? ($call->status === 'abierta' ? 'Open' : 'Closed') : ucfirst($call->status) }}
            </span>
        </div>
        <h1 class="text-2xl sm:text-4xl font-extrabold text-white leading-tight">
            {{ $call->trans('title') }}
        </h1>
        @if($call->deadline_date)
        <p class="text-xs text-emerald-200 mt-3">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Application deadline: ' : 'Fecha límite de postulación: ' }}
            <strong class="text-white">{{ $call->deadline_date->format(($currentLocale ?? 'es') === 'en' ? 'F d, Y' : 'd \d\e F \d\e Y') }}</strong>
        </p>
        @endif
    </div>
</section>

<section class="py-12 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="card-molinero p-6">
                <h2 class="text-base font-bold text-[var(--text-primary)] mb-3">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Call Description' : 'Descripción de la Convocatoria' }}
                </h2>
                <div class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed space-y-3 prose dark:prose-invert max-w-none">
                    {!! $call->trans('description') !!}
                </div>
            </div>

            @if($call->requirements)
            <div class="card-molinero p-6">
                <h2 class="text-base font-bold text-[var(--text-primary)] mb-3">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Application Requirements' : 'Requisitos de Postulación' }}
                </h2>
                <div class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed space-y-2">
                    @if(($currentLocale ?? 'es') === 'en')
                        {!! \App\Services\TranslationService::translate($call->requirements, 'es', 'en') !!}
                    @else
                        {!! $call->requirements !!}
                    @endif
                </div>
            </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="card-molinero p-6">
                <h3 class="text-sm font-bold text-[var(--text-primary)] mb-4">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Key Information' : 'Información Clave' }}
                </h3>
                <div class="space-y-3 text-xs text-[var(--text-secondary)]">
                    <div>
                        <span class="text-[var(--text-muted)] block">{{ ($currentLocale ?? 'es') === 'en' ? 'Program Type:' : 'Tipo de Programa:' }}</span>
                        <span class="font-semibold text-[var(--text-primary)]">{{ ($currentLocale ?? 'es') === 'en' ? ($callTypeMap[strtolower($call->call_type)] ?? ucfirst($call->call_type)) : ucfirst($call->call_type) }}</span>
                    </div>
                    <div>
                        <span class="text-[var(--text-muted)] block">{{ ($currentLocale ?? 'es') === 'en' ? 'Target Audience:' : 'Público Destinatario:' }}</span>
                        <span class="font-semibold text-[var(--text-primary)]">{{ ($currentLocale ?? 'es') === 'en' ? ($audMap[strtolower($call->target_audience)] ?? ucfirst(str_replace('_', ' ', $call->target_audience))) : ucfirst(str_replace('_', ' ', $call->target_audience)) }}</span>
                    </div>
                    @if($call->deadline_date)
                    <div>
                        <span class="text-[var(--text-muted)] block">{{ ($currentLocale ?? 'es') === 'en' ? 'Call Deadline:' : 'Cierre de Convocatoria:' }}</span>
                        <span class="font-semibold text-emerald-700 dark:text-emerald-400">{{ $call->deadline_date->format(($currentLocale ?? 'es') === 'en' ? 'M d, Y' : 'd/m/Y') }}</span>
                    </div>
                    @endif
                </div>

                <div class="mt-6 pt-4 border-t border-[var(--border-color)] space-y-2">
                    @if($call->apply_url)
                    <a href="{{ $call->apply_url }}" target="_blank" rel="noopener noreferrer" class="btn-molinero text-xs w-full text-center">
                        {{ ($currentLocale ?? 'es') === 'en' ? 'Apply on Official Platform →' : 'Postular en Plataforma Oficial →' }}
                    </a>
                    @endif

                    @if($call->requirements_file_path)
                    <a href="{{ asset($call->requirements_file_path) }}" target="_blank" rel="noopener noreferrer" class="btn-molinero-outline text-xs w-full text-center">
                        {{ ($currentLocale ?? 'es') === 'en' ? 'Download Guidelines (PDF)' : 'Descargar Bases (PDF)' }}
                    </a>
                    @endif
                </div>
            </div>

            <div class="card-molinero p-5 bg-emerald-50/40 dark:bg-emerald-950/20">
                <h4 class="text-xs font-bold text-[var(--text-primary)] mb-1">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'Have questions about this call?' : '¿Tienes dudas sobre esta beca?' }}
                </h4>
                <p class="text-[11px] text-[var(--text-secondary)] mb-3">
                    {{ ($currentLocale ?? 'es') === 'en' ? 'The OGI mobility and cooperation office provides personalized advice to applicants.' : 'La coordinación de movilidad de la OGI brinda asesoría personalizada a los postulantes.' }}
                </p>
                <a href="mailto:{{ $call->contact_email ?: 'ogi@lamolina.edu.pe' }}" class="text-xs font-bold text-[#0F5132] dark:text-emerald-400 hover:underline">
                    {{ $call->contact_email ?: 'ogi@lamolina.edu.pe' }}
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

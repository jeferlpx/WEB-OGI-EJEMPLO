@extends('layouts.app')

@section('title', $article->trans('title'))

@section('content')
@php
    $catMap = [
        'convenio' => 'Agreement',
        'movilidad' => 'Mobility',
        'visita' => 'Visit',
        'evento' => 'Event',
    ];
@endphp

<section class="bg-gradient-to-r from-emerald-950 to-[#0F5132] text-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('news.index') }}" class="text-xs text-emerald-300 hover:text-white flex items-center gap-1 mb-3">
            {{ ($currentLocale ?? 'es') === 'en' ? '← Back to News' : '← Volver a Noticias' }}
        </a>
        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-300 block mb-1">
            {{ ($currentLocale ?? 'es') === 'en' ? ($catMap[strtolower($article->category)] ?? ucfirst($article->category)) : ucfirst($article->category) }} • {{ $article->published_at->format(($currentLocale ?? 'es') === 'en' ? 'F d, Y' : 'd \d\e F \d\e Y') }}
        </span>
        <h1 class="text-2xl sm:text-4xl font-extrabold text-white leading-tight">
            {{ $article->trans('title') }}
        </h1>
    </div>
</section>

<section class="py-12 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <article class="card-molinero p-8 space-y-6">
        <div class="text-sm font-medium text-[var(--text-primary)] border-l-4 border-l-[#0F5132] pl-4 italic">
            {{ $article->trans('summary') }}
        </div>

        <div class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed space-y-4 pt-4 border-t border-[var(--border-color)]">
            {!! $article->trans('content') !!}
        </div>

        <div class="pt-6 border-t border-[var(--border-color)] flex items-center justify-between text-xs text-[var(--text-muted)]">
            <span>
                {{ ($currentLocale ?? 'es') === 'en' 
                    ? 'Source: ' . (in_array($article->author_name, ['Oficina de Gestión Interinstitucional', 'Oficina de Gestión Interinstitucional y Asuntos Globales']) ? 'Office of Inter-institutional Management and Global Affairs' : $article->author_name)
                    : 'Fuente: ' . $article->author_name }}
            </span>
            <a href="{{ route('news.index') }}" class="text-[#0F5132] dark:text-emerald-400 font-semibold hover:underline">
                {{ ($currentLocale ?? 'es') === 'en' ? '← All news articles' : '← Todas las noticias' }}
            </a>
        </div>
    </article>
</section>
@endsection

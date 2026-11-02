@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'News & Events — OGI UNALM' : 'Noticias y Eventos — OGI UNALM')

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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs uppercase font-bold tracking-wider text-emerald-300">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Press Room & Communications' : 'Sala de Prensa y Comunicación' }}
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-1 mb-3">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Institutional News & Events' : 'Noticias y Eventos Institucionales' }}
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed max-w-3xl">
            {{ ($currentLocale ?? 'es') === 'en'
                ? 'Bilateral agreements, protocol visits from foreign delegations, scientific events, and global accomplishments of the Molinero community.'
                : 'Acuerdos bilaterales, visitas protocolares de delegaciones extranjeras, eventos científicos y logros de la comunidad molinera en el mundo.' }}
        </p>
    </div>
</section>

<section class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($news as $article)
        <article class="card-molinero flex flex-col justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-1 block">
                    {{ ($currentLocale ?? 'es') === 'en' ? ($catMap[strtolower($article->category)] ?? ucfirst($article->category)) : ucfirst($article->category) }} • {{ $article->published_at->format(($currentLocale ?? 'es') === 'en' ? 'M d, Y' : 'd/m/Y') }}
                </span>
                <h2 class="text-base font-bold text-[var(--text-primary)] mb-2 line-clamp-2">
                    <a href="{{ route('news.show', $article->slug) }}" class="hover:text-[#0F5132] dark:hover:text-emerald-400">
                        {{ $article->trans('title') }}
                    </a>
                </h2>
                <p class="text-xs text-[var(--text-secondary)] line-clamp-3 mb-4">
                    {{ $article->trans('summary') }}
                </p>
            </div>
            <a href="{{ route('news.show', $article->slug) }}" class="text-xs font-semibold text-[#0F5132] dark:text-emerald-400 hover:underline">
                {{ ($currentLocale ?? 'es') === 'en' ? 'Read full article →' : 'Leer artículo completo →' }}
            </a>
        </article>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $news->links() }}
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', ($currentLocale ?? 'es') === 'en' ? 'Academic & Scientific Networks — OGI UNALM' : 'Redes Académicas y Científicas — OGI UNALM')

@section('content')
<section class="bg-gradient-to-r from-emerald-950 to-[#0F5132] text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs uppercase font-bold tracking-wider text-emerald-300">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Transnational Cooperation' : 'Cooperación Transnacional' }}
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-1 mb-3">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Global Networks & Consortiums' : 'Redes y Consorcios Globales' }}
        </h1>
        <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed max-w-3xl">
            {{ ($currentLocale ?? 'es') === 'en'
                ? 'UNALM actively participates in inter-university networks, scientific associations, and international technical cooperation forums to strengthen agricultural, environmental, and bio-economic research.'
                : 'La UNALM participa activamente en redes interuniversitarias, asociaciones científicas y foros de cooperación técnica internacional para fortalecer la investigación agraria y ambiental.' }}
        </p>
    </div>
</section>

<section class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <!-- Redes Internacionales y Agencias -->
    <div>
        <h2 class="text-xl font-bold text-[var(--text-primary)] mb-6">
            {{ ($currentLocale ?? 'es') === 'en' ? 'Cooperation Agencies and Global Networks' : 'Agencias de Cooperación y Redes Globales' }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($internationalPartners as $partner)
            @php
                $partnerLogo = ($partner->logo_path && file_exists(public_path($partner->logo_path))) 
                    ? asset($partner->logo_path) 
                    : asset(($currentLocale ?? 'es') === 'en' ? 'imagenes/placeholder_referencia_en.svg' : 'imagenes/placeholder_referencia.svg');
            @endphp
            <div class="card-molinero flex flex-col justify-between">
                <div>
                    <div class="h-32 sm:h-36 flex items-center justify-center p-4 mb-4 bg-white dark:bg-[#121F19] rounded-xl border border-gray-200/80 dark:border-emerald-900/40 shadow-sm">
                        <img src="{{ $partnerLogo }}" alt="{{ $partner->name }}" class="max-h-24 w-auto max-w-[85%] object-contain" />
                    </div>
                    <h3 class="text-base font-bold text-[var(--text-primary)] mb-2">{{ $partner->name }}</h3>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        {{ $partner->trans('description') }}
                    </p>
                </div>
                @if($partner->website_url)
                <div class="pt-4 border-t border-[var(--border-color)] mt-4">
                    <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="text-xs font-semibold text-[#0F5132] dark:text-emerald-400 hover:underline flex items-center gap-1">
                        <span>{{ ($currentLocale ?? 'es') === 'en' ? 'Visit official website' : 'Visitar portal oficial' }}</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    <!-- Redes Estudiantiles Oficiales -->
    <div class="card-molinero p-8 bg-emerald-50/50 dark:bg-emerald-950/10 border-emerald-200 dark:border-emerald-900">
        <h2 class="text-lg font-bold text-[var(--text-primary)] mb-2">
            {{ ($currentLocale ?? 'es') === 'en' ? 'International Student Networks at UNALM' : 'Redes Estudiantiles Internacionales en la UNALM' }}
        </h2>
        <p class="text-xs text-[var(--text-secondary)] mb-6">
            {{ ($currentLocale ?? 'es') === 'en' 
                ? "Our students actively lead chapters of the world's most prestigious agricultural and forestry student organizations:" 
                : 'Nuestros estudiantes lideran capítulos de las organizaciones agrarias y forestales más prestigiosas del mundo:' }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <div class="p-4 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] shadow-sm">
                <span class="text-base font-bold text-[#0F5132] dark:text-emerald-400 block mb-1">IAAS</span>
                <span class="text-[11px] text-[var(--text-muted)] block">International Association of Students in Agricultural and Related Sciences</span>
            </div>
            <div class="p-4 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] shadow-sm">
                <span class="text-base font-bold text-[#0F5132] dark:text-emerald-400 block mb-1">IFSA</span>
                <span class="text-[11px] text-[var(--text-muted)] block">{{ ($currentLocale ?? 'es') === 'en' ? "International Forestry Students' Association (Peru Chapter)" : "International Forestry Students' Association (Capítulo Perú)" }}</span>
            </div>
            <div class="p-4 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] shadow-sm">
                <span class="text-base font-bold text-[#0F5132] dark:text-emerald-400 block mb-1">REDI Perú</span>
                <span class="text-[11px] text-[var(--text-muted)] block">{{ ($currentLocale ?? 'es') === 'en' ? 'Students Network for Internationalization' : 'Red de Estudiantes por la Internacionalización' }}</span>
            </div>
            <div class="p-4 bg-[var(--bg-surface)] rounded-lg border border-[var(--border-color)] shadow-sm">
                <span class="text-base font-bold text-[#0F5132] dark:text-emerald-400 block mb-1">RUNAI</span>
                <span class="text-[11px] text-[var(--text-muted)] block">{{ ($currentLocale ?? 'es') === 'en' ? 'National University Network for International Affairs' : 'Red Universitaria Nacional de Asuntos Internacionales' }}</span>
            </div>
        </div>
    </div>
</section>
@endsection

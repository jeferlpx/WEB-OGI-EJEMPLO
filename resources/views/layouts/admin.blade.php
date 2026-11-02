<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Intranet CMS') — OGI UNALM</title>

    <!-- Preconnect & Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Compiled Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        (function() {
            const stored = localStorage.getItem('ogi_theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (stored === 'dark' || (!stored && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>
<body class="min-h-screen bg-[var(--bg-page)] text-[var(--text-primary)] antialiased flex flex-col md:flex-row font-sans">
    <!-- Barra Lateral (Sidebar) de Administración -->
    <aside class="w-full md:w-72 bg-[#0A3622] text-white flex flex-col justify-between flex-shrink-0 border-r border-emerald-900 shadow-xl">
        <div>
            <!-- Cabecera del Panel -->
            <div class="p-5 border-b border-emerald-900/80 space-y-3">
                <a href="{{ route('admin.dashboard') }}" class="block">
                    <img src="{{ asset('imagenes/logo_footer.png') }}" alt="UNALM" class="h-9 w-auto max-w-full object-contain" />
                </a>
                <div class="pt-2 border-t border-emerald-900/60 flex items-center justify-between">
                    <div>
                        <h1 class="text-xs font-bold text-white tracking-wider uppercase">Intranet OGI</h1>
                        <span class="text-[10px] text-emerald-300 font-medium block">Gestión Institucional</span>
                    </div>
                    <span class="text-[9px] bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 px-2 py-0.5 rounded-full font-bold uppercase tracking-wider">CMS v2.0</span>
                </div>
            </div>

            <!-- Datos del Usuario Activo -->
            <div class="px-5 py-4 bg-[#082819] border-b border-emerald-900/60">
                <p class="text-xs font-semibold text-white truncate">{{ auth()->user()?->name ?? 'Administrador OGI' }}</p>
                <div class="flex items-center gap-2 mt-1">
                    <span class="inline-block px-2 py-0.5 text-[10px] uppercase font-bold rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                        {{ auth()->user()?->role ?? 'Admin' }}
                    </span>
                    <span class="text-[11px] text-emerald-400/80 truncate">{{ auth()->user()?->email ?? 'admin@lamolina.edu.pe' }}</span>
                </div>
            </div>

            <!-- Navegación del CMS -->
            <nav class="p-3 space-y-1 text-xs font-medium">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-700/80 text-white font-semibold shadow-sm' : 'text-emerald-100/90 hover:bg-emerald-800/50 hover:text-white' }}">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard y Métricas</span>
                </a>

                <a href="{{ route('admin.agreements.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.agreements.*') ? 'bg-emerald-700/80 text-white font-semibold shadow-sm' : 'text-emerald-100/90 hover:bg-emerald-800/50 hover:text-white' }}">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Gestión de Convenios</span>
                </a>

                <a href="{{ route('admin.calls.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.calls.*') ? 'bg-emerald-700/80 text-white font-semibold shadow-sm' : 'text-emerald-100/90 hover:bg-emerald-800/50 hover:text-white' }}">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    <span>Becas y Convocatorias</span>
                </a>

                <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.news.*') ? 'bg-emerald-700/80 text-white font-semibold shadow-sm' : 'text-emerald-100/90 hover:bg-emerald-800/50 hover:text-white' }}">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <span>Noticias y Eventos</span>
                </a>

                <a href="{{ route('admin.resources.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.resources.*') ? 'bg-emerald-700/80 text-white font-semibold shadow-sm' : 'text-emerald-100/90 hover:bg-emerald-800/50 hover:text-white' }}">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    <span>Biblioteca de Medios y Docs</span>
                </a>

                <a href="{{ route('admin.partners.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.partners.*') ? 'bg-emerald-700/80 text-white font-semibold shadow-sm' : 'text-emerald-100/90 hover:bg-emerald-800/50 hover:text-white' }}">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Aliados Estratégicos y Redes</span>
                </a>

                <a href="{{ route('admin.pages.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.pages.*') ? 'bg-emerald-700/80 text-white font-semibold shadow-sm' : 'text-emerald-100/90 hover:bg-emerald-800/50 hover:text-white' }}">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                    <span>Módulos y Páginas Web</span>
                </a>

                <a href="{{ route('admin.team.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.team.*') ? 'bg-emerald-700/80 text-white font-semibold shadow-sm' : 'text-emerald-100/90 hover:bg-emerald-800/50 hover:text-white' }}">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span>Directorio / Equipo OGI</span>
                </a>

                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-emerald-700/80 text-white font-semibold shadow-sm' : 'text-emerald-100/90 hover:bg-emerald-800/50 hover:text-white' }}">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Ajustes y Contenidos</span>
                </a>

                <a href="{{ route('admin.audit.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.audit.*') ? 'bg-emerald-700/80 text-white font-semibold shadow-sm' : 'text-emerald-100/90 hover:bg-emerald-800/50 hover:text-white' }}">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Trazabilidad y Auditoría</span>
                </a>

                @if(auth()->user()?->isSuperAdmin())
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-emerald-700/80 text-white font-semibold shadow-sm' : 'text-emerald-100/90 hover:bg-emerald-800/50 hover:text-white' }}">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span>Usuarios y Roles</span>
                </a>
                @endif
            </nav>
        </div>

        <!-- Acciones Inferiores -->
        <div class="p-4 border-t border-emerald-900/80 space-y-2">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-2 px-3 text-xs font-semibold rounded-lg bg-emerald-800/60 hover:bg-emerald-800 text-emerald-200 hover:text-white transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>Ver Portal Público</span>
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 w-full py-2 px-3 text-xs font-semibold rounded-lg bg-red-950/40 hover:bg-red-900/60 text-red-200 hover:text-white border border-red-900/40 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Área de Trabajo Principal -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <!-- Barra Superior del Panel -->
        <header class="bg-[var(--bg-surface)] border-b border-[var(--border-color)] py-3 px-6 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <span class="text-xs font-semibold text-[var(--text-muted)] uppercase tracking-wider">
                    Panel Administrativo OGI
                </span>
            </div>

            <div class="flex items-center gap-3">
                <!-- Modo Oscuro / Claro -->
                <button type="button" class="theme-toggle p-2 rounded-lg border border-[var(--border-color)] text-[var(--text-secondary)] hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors shadow-sm" title="Alternar Modo Oscuro / Claro">
                    <svg class="w-4 h-4 theme-icon-sun text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <svg class="w-4 h-4 theme-icon-moon text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>
            </div>
        </header>

        <!-- Mensajes Flash de Éxito / Error -->
        <div class="px-6 pt-4">
            @if(session('success'))
            <div class="bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-300 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 px-4 py-3 rounded-lg text-sm flex items-center justify-between mb-4 shadow-sm" role="alert">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if(session('error') || (!empty($errors) && $errors->any()))
            <div class="bg-red-50 dark:bg-red-950/40 border border-red-300 dark:border-red-800 text-red-800 dark:text-red-300 px-4 py-3 rounded-lg text-sm mb-4 shadow-sm" role="alert">
                <div class="flex items-center gap-2 font-semibold">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Atención: Por favor revise los siguientes errores:</span>
                </div>
                <ul class="mt-2 ml-7 list-disc text-xs space-y-1">
                    @if(session('error')) <li>{{ session('error') }}</li> @endif
                    @if(!empty($errors))
                        @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                    @endif
                </ul>
            </div>
            @endif
        </div>

        <!-- Contenedor Principal de Vistas -->
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>

    <!-- Script Global de Auto-Traducción Inteligente para Formularios del CMS -->
    <script>
        window.autoTranslateForm = async function(buttonEl) {
            const form = buttonEl ? buttonEl.closest('form') : document.querySelector('form');
            if (!form) return;

            const fieldsToTranslate = {};
            const elementsToUpdate = {};

            const inputs = form.querySelectorAll('input[name], textarea[name]');
            inputs.forEach(input => {
                const name = input.name;
                if (!name.endsWith('_en') && !name.startsWith('_') && input.type !== 'file' && input.type !== 'hidden') {
                    const enInput = form.querySelector(`[name="${name}_en"]`);
                    if (enInput) {
                        const val = input.value.trim();
                        if (val) {
                            fieldsToTranslate[name] = val;
                            elementsToUpdate[name] = enInput;
                        }
                    }
                }
            });

            if (Object.keys(fieldsToTranslate).length === 0) {
                alert('Por favor ingrese primero los textos en español en el formulario para traducirlos a inglés.');
                return;
            }

            const originalBtnHtml = buttonEl ? buttonEl.innerHTML : '';
            if (buttonEl) {
                buttonEl.disabled = true;
                buttonEl.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-emerald-600 inline" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    Traduciendo con IA...
                `;
            }

            try {
                const response = await fetch('{{ route("admin.api.translate") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        fields: fieldsToTranslate,
                        from: 'es',
                        to: 'en'
                    })
                });

                const data = await response.json();
                if (data.success && data.translations) {
                    let count = 0;
                    for (const [key, translatedText] of Object.entries(data.translations)) {
                        if (elementsToUpdate[key]) {
                            elementsToUpdate[key].value = translatedText;
                            elementsToUpdate[key].classList.add('ring-2', 'ring-emerald-500', 'bg-emerald-50/40', 'dark:bg-emerald-950/40');
                            setTimeout(() => {
                                elementsToUpdate[key].classList.remove('ring-2', 'ring-emerald-500', 'bg-emerald-50/40', 'dark:bg-emerald-950/40');
                            }, 2500);
                            count++;
                        }
                    }

                    const toast = document.createElement('div');
                    toast.className = 'fixed bottom-5 right-5 z-50 bg-[#0F5132] text-white px-5 py-3 rounded-xl shadow-2xl flex items-center gap-2 text-xs font-bold border border-emerald-400';
                    toast.innerHTML = `
                        <svg class="w-5 h-5 text-emerald-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>¡${count} campos traducidos exitosamente al inglés! Puede revisarlos o afinarlos antes de guardar.</span>
                    `;
                    document.body.appendChild(toast);
                    setTimeout(() => toast.remove(), 4500);
                } else {
                    alert('No se pudo traducir automáticamente: ' + (data.message || 'Error del servidor'));
                }
            } catch (e) {
                console.error(e);
                alert('Error de conexión al traducir. Verifique su red.');
            } finally {
                if (buttonEl) {
                    buttonEl.disabled = false;
                    buttonEl.innerHTML = originalBtnHtml;
                }
            }
        };
    </script>
</body>
</html>

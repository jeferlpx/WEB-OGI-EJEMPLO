<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso Intranet — OGI UNALM</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex items-center justify-center bg-gradient-to-br from-emerald-950 via-[#0A3622] to-gray-900 px-4 sm:px-6">
    <div class="max-w-md w-full bg-[var(--bg-surface)] rounded-2xl shadow-2xl border border-[var(--border-color)] p-8">
        <!-- Encabezado con Logotipo Institucional -->
        <div class="text-center mb-6">
            <img src="{{ asset('imagenes/logo_trans.png') }}" alt="UNALM" class="dark:hidden h-14 w-auto mx-auto mb-3 object-contain" />
            <img src="{{ asset('imagenes/logo_footer.png') }}" alt="UNALM" class="hidden dark:block h-14 w-auto mx-auto mb-3 object-contain" />
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Intranet Administrativa OGI</h1>
            <p class="text-xs text-[var(--text-muted)] mt-1">Universidad Nacional Agraria La Molina</p>
        </div>

        @if(session('success'))
        <div class="mb-4 p-3 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-300 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 rounded-lg text-xs">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 dark:bg-red-950/40 border border-red-300 dark:border-red-800 text-red-800 dark:text-red-300 rounded-lg text-xs space-y-1">
            @foreach($errors->all() as $err)
            <div>{{ $err }}</div>
            @endforeach
        </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">
                    Correo Electrónico Institucional
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="usuario@lamolina.edu.pe" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">
                    Contraseña de Acceso
                </label>
                <input type="password" name="password" id="password" required placeholder="••••••••" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-2 cursor-pointer text-[var(--text-secondary)]">
                    <input type="checkbox" name="remember" class="rounded text-[#0F5132] focus:ring-[#0F5132]" />
                    <span>Recordar sesión</span>
                </label>
            </div>

            <button type="submit" class="w-full btn-molinero py-2.5 text-xs font-bold shadow-md mt-2">
                Iniciar Sesión en Intranet
            </button>
        </form>

        <div class="mt-6 pt-4 border-t border-[var(--border-color)] text-center text-xs text-[var(--text-muted)]">
            <a href="{{ route('home') }}" class="hover:text-[#0F5132] dark:hover:text-emerald-400 font-medium">← Volver al portal público</a>
        </div>
    </div>
</body>
</html>

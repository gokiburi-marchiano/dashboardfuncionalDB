<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Gobierno de Chile') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased bg-[#eff2f3]">
        <div class="min-h-screen">

            <nav class="bg-[#003399] shadow-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-14 items-center">

                        <div class="flex items-center space-x-3">
                            <div class="flex flex-col leading-none border-l-2 border-white/30 pl-3">
                                <span class="text-white font-black text-lg tracking-tighter">GOBIERNO DE</span>
                                <span class="text-white font-light text-md tracking-widest uppercase italic">Chile</span>
                            </div>
                        </div>

                        <div class="flex items-center space-x-6">
                            <div class="hidden sm:flex flex-col items-end border-r border-white/20 pr-4">
                                <span class="text-white text-[9px] opacity-70 uppercase font-bold tracking-tighter">RUT Sesión:</span>
                                <span class="text-white text-xs font-medium">{{ Auth::user()->rut }}</span>
                            </div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-white hover:text-[#ee3a43] text-[10px] font-bold transition uppercase tracking-widest">
                                    Finalizar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="bg-white border-b border-gray-200 sticky top-0 z-40 shadow-sm">
                <div class="h-[6px] bg-[#ee3a43]"></div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex space-x-8 h-12 items-center">

                        <a href="{{ route('dashboard') }}"
                           class="h-full flex items-center text-[11px] font-bold uppercase tracking-wider transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'text-[#003399] border-b-2 border-[#003399]' : 'text-gray-500 hover:text-[#003399]' }}">
                            Inicio
                        </a>

                        <a href="{{ route('solicitudes.create') }}"
                           class="h-full flex items-center text-[11px] font-bold uppercase tracking-wider transition-colors duration-200 {{ request()->routeIs('solicitudes.create') ? 'text-[#003399] border-b-2 border-[#003399]' : 'text-gray-500 hover:text-[#003399]' }}">
                            Nueva Solicitud
                        </a>

                        <a href="{{ route('solicitudes.index') }}"
                           class="h-full flex items-center text-[11px] font-bold uppercase tracking-wider transition-colors duration-200 {{ request()->routeIs('solicitudes.index') ? 'text-[#003399] border-b-2 border-[#003399]' : 'text-gray-500 hover:text-[#003399]' }}">
                            Mis Trámites
                        </a>

                        <a href="{{ route('profile.edit') }}"
                           class="h-full flex items-center text-[11px] font-bold uppercase tracking-wider transition-colors duration-200 {{ request()->routeIs('profile.edit') ? 'text-[#003399] border-b-2 border-[#003399]' : 'text-gray-500 hover:text-[#003399]' }}">
                            Mi Perfil
                        </a>

                    </div>
                </div>
            </div>

            @isset($header)
                <header class="bg-white/50 backdrop-blur-sm border-b border-gray-200">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        <div class="text-[#003399] font-semibold text-sm">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>

            <footer class="mt-20 py-10 bg-white border-t border-gray-200">
                <div class="max-w-7xl mx-auto px-4 text-center">
                    <p class="text-[10px] text-gray-400 uppercase tracking-[0.25em] font-bold">
                        Sistema de Gestión Institucional — 2026
                    </p>
                    <div class="mt-4 flex justify-center space-x-4 opacity-30 grayscale">
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>

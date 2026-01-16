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

        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'gob-primary': '#006FB3',
                            'gob-secondary': '#FE6565',
                            'gob-black': '#111111',
                            'gob-gray-a': '#4A4A4A',
                            'gob-gray-b': '#8A8A8A',
                            'gob-accent': '#A8B7C7',
                            'gob-bg-light': '#EEEEEE',
                        }
                    }
                }
            }
        </script>

        <style>
            body { background-color: #EEEEEE; color: #4A4A4A; }
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans antialiased bg-gob-bg-light">
        <div class="min-h-screen">

            <nav class="bg-gob-primary shadow-lg border-b border-white/10 relative z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-14 items-center">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('dashboard') }}">
                                <div class="flex flex-col leading-none border-l-2 border-white/30 pl-3">
                                    <span class="text-white font-black text-lg tracking-tighter">GOBIERNO DE</span>
                                    <span class="text-white font-light text-md tracking-widest uppercase italic">Chile</span>
                                </div>
                            </a>
                        </div>
                        <div class="flex items-center space-x-6">
                            <div class="hidden sm:flex flex-col items-end border-r border-white/20 pr-4">
                                <span class="text-white text-[9px] opacity-70 uppercase font-bold tracking-tighter">RUT Sesión:</span>
                                <span class="text-white text-xs font-medium">{{ Auth::user()->rut ?? 'Invitado' }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-white hover:text-gob-secondary text-[10px] font-bold transition uppercase tracking-widest">
                                    Finalizar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="bg-white border-b border-gob-accent sticky top-0 z-40 shadow-sm overflow-visible">
                <div class="h-[4px] bg-gob-secondary"></div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                    <div class="flex justify-between h-12 items-center">

                        <div class="flex-1 flex space-x-8 h-full items-center overflow-x-auto pr-4">
                            @php
                                $navClass = "h-full flex items-center text-[11px] font-bold uppercase tracking-wider transition-colors duration-200 whitespace-nowrap";
                            @endphp

                            <a href="{{ route('dashboard') }}" class="{{ $navClass }} {{ request()->routeIs('dashboard') ? 'text-gob-primary border-b-2 border-gob-primary' : 'text-gob-gray-a hover:text-gob-primary' }}">
                                Inicio
                            </a>
                            <a href="{{ route('solicitudes.create') }}" class="{{ $navClass }} {{ request()->routeIs('solicitudes.create') ? 'text-gob-primary border-b-2 border-gob-primary' : 'text-gob-gray-a hover:text-gob-primary' }}">
                                Nueva Solicitud
                            </a>
                            <a href="{{ route('solicitudes.index') }}" class="{{ $navClass }} {{ request()->routeIs('solicitudes.index') ? 'text-gob-primary border-b-2 border-gob-primary' : 'text-gob-gray-a hover:text-gob-primary' }}">
                                Mis Trámites
                            </a>
                            <a href="{{ route('profile.edit') }}" class="{{ $navClass }} {{ request()->routeIs('profile.edit') ? 'text-gob-primary border-b-2 border-gob-primary' : 'text-gob-gray-a hover:text-gob-primary' }}">
                                Mi Perfil
                            </a>
                        </div>

                        @if(Auth::user()->role === 'admin')
                            <div class="relative ml-4 shrink-0 h-full flex items-center z-50" x-data="{ open: false }">

                                <button @click="open = ! open" class="flex items-center gap-2 h-8 px-3 bg-red-50 text-red-700 text-[10px] font-black uppercase tracking-widest rounded hover:bg-red-100 transition focus:outline-none border border-red-100 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>

                                    <span>Administración</span>

                                    <svg class="w-3 h-3 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>

                                <div x-show="open"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     @click.away="open = false"
                                     style="display: none;"
                                     class="absolute top-[calc(100%+5px)] right-0 w-56 bg-white border border-gray-200 shadow-2xl rounded-md z-50 py-2">

                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-xs text-gray-700 hover:bg-red-50 hover:text-red-700 transition flex items-center gap-2 border-b border-gray-50">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                        <span class="font-medium">Panel de Control</span>
                                    </a>

                                    <a href="{{ route('admin.users.index') }}" class="block px-4 py-3 text-xs text-gray-700 hover:bg-red-50 hover:text-red-700 transition flex items-center gap-2 border-b border-gray-50">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        <span class="font-medium">Usuarios del Sistema</span>
                                    </a>

                                    <a href="{{ route('admin.solicitudes.index') }}" class="block px-4 py-3 text-xs text-gray-700 hover:bg-red-50 hover:text-red-700 transition flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path></svg>
                                        <span class="font-medium">Gestión de Trámites</span>
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            @isset($header)
                <header class="bg-white border-b border-gob-accent shadow-sm relative z-10">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        <div class="text-gob-primary font-semibold text-sm">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <main class="py-12 relative z-0">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @if (session('status'))
                        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 text-xs font-bold uppercase shadow-sm" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 text-xs font-bold uppercase shadow-sm" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>

            <footer class="mt-20 py-10 bg-white border-t border-gob-accent relative z-10">
                <div class="max-w-7xl mx-auto px-4 text-center">
                    <div class="flex justify-center mb-4">
                        <div class="flex flex-col leading-none border-l-2 border-gob-gray-b pl-3 text-left opacity-50">
                            <span class="text-gob-black font-black text-sm tracking-tighter">GOBIERNO DE</span>
                            <span class="text-gob-black font-light text-xs tracking-widest uppercase italic">Chile</span>
                        </div>
                    </div>
                    <p class="text-[10px] text-gob-gray-b uppercase tracking-[0.25em] font-bold">
                        Sistema de Gestión Institucional — {{ date('Y') }}
                    </p>
                </div>
            </footer>
        </div>
    </body>
</html>

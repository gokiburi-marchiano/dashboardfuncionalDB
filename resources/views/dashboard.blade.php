<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <span class="text-sm font-medium text-[#003399] uppercase tracking-tighter">Portal Funcionario</span>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <span class="mx-2 text-gray-400">/</span>
                            <span class="text-sm font-bold text-gray-700 uppercase tracking-tighter">Panel Principal</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="flex items-center space-x-2">
                <span class="flex h-2 w-2 rounded-full bg-green-500"></span>
                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Sistema Operativo</span>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white shadow-sm border-t-4 border-[#003399] p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Identificación</p>
                            <h3 class="text-xl font-black text-gray-800 mt-1">{{ Auth::user()->name }}</h3>
                        </div>
                        <span class="text-2xl">👤</span>
                    </div>
                </div>

                <div class="bg-white shadow-sm border-t-4 border-[#D52B1E] p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">RUT Registrado</p>
                            <h3 class="text-xl font-black text-gray-800 mt-1">{{ Auth::user()->rut }}</h3>
                        </div>
                        <span class="text-2xl">🆔</span>
                    </div>
                </div>

                <div class="bg-white shadow-sm border-t-4 border-gray-400 p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Jurisdicción</p>
                            <h3 class="text-xl font-black text-gray-800 mt-1">Nivel Central</h3>
                        </div>
                        <span class="text-2xl">🏛️</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-8">
                            <div class="flex items-center mb-6">
                                <div class="w-1 h-6 bg-[#D52B1E] mr-3"></div>
                                <h3 class="text-lg font-bold text-[#003399] uppercase tracking-tight">Comunicado Institucional</h3>
                            </div>
                            <p class="text-gray-600 leading-relaxed text-sm">
                                Le damos la bienvenida al sistema de gestión. A través de esta interfaz, usted podrá realizar el seguimiento de sus procesos administrativos de manera transparente. El uso de esta plataforma está regulado por las normativas de seguridad de la información vigentes.
                            </p>
                            <div class="mt-6 flex items-center p-4 bg-gray-50 border-l-4 border-[#003399]">
                                <div class="flex-shrink-0 text-[#003399]">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs text-gray-700 font-medium italic">
                                        Sus datos han sido validados exitosamente mediante el sistema nacional de identidad.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="font-bold text-xs text-gray-400 uppercase tracking-widest">Documentos Recientes</h3>
                            <a href="{{ route('solicitudes.index') }}" class="text-[10px] font-bold text-[#003399] hover:underline">VER TODO</a>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @forelse($recientes as $doc)
                                <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition">
                                    <div class="flex items-center">
                                        <span class="text-xl mr-3">{{ $doc->archivo_path ? '📁' : '📄' }}</span>
                                        <div>
                                            <p class="text-sm font-bold text-gray-800 tracking-tight">{{ $doc->titulo }}</p>
                                            <p class="text-[10px] text-gray-400 uppercase">
                                                {{ $doc->departamento }} | {{ $doc->estado }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="text-[10px] text-gray-400">{{ $doc->created_at->diffForHumans() }}</span>
                                        @if($doc->archivo_path)
                                            <a href="{{ Storage::url($doc->archivo_path) }}" target="_blank" class="text-[9px] font-bold text-[#003399] mt-1 hover:underline">
                                                ABRIR ADJUNTO
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center">
                                    <p class="text-xs text-gray-400 italic">No registra trámites en el sistema.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white shadow-sm border border-gray-200 p-6 text-center">
                        <h4 class="font-bold text-gray-700 uppercase text-[10px] tracking-[0.2em] mb-6">Trámites Rápidos</h4>
                        <div class="space-y-3">
                            <a href="{{ route('profile.edit') }}" class="block w-full py-3 bg-[#003399] text-white text-[11px] font-black uppercase tracking-[0.1em] hover:bg-blue-800 transition text-center">
                                Editar Mi Perfil
                            </a>

                            <a href="{{ route('solicitudes.create') }}" class="block w-full py-3 border-2 border-[#003399] text-[#003399] text-[11px] font-black uppercase tracking-[0.1em] hover:bg-gray-50 transition text-center">
                                Nueva Solicitud
                            </a>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-100 p-6 rounded-sm">
                        <h5 class="text-[#003399] font-bold text-xs uppercase mb-2">Soporte Técnico</h5>
                        <p class="text-[11px] text-gray-600 leading-tight">Para reportar incidentes, por favor contacte a la mesa de ayuda interna o escriba a soporte@gobierno.cl</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

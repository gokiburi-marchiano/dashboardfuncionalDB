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
                            <span class="text-sm font-bold text-gray-700 uppercase tracking-tighter">Historial de Trámites</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <a href="{{ route('solicitudes.create') }}" class="bg-[#003399] text-white px-4 py-2 text-[10px] font-black uppercase tracking-widest hover:bg-blue-800 transition shadow-sm">
                + Nueva Solicitud
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-xl border-t-4 border-[#D52B1E] overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="font-black text-xs text-gray-500 uppercase tracking-[0.2em]">Registro Maestro de Solicitudes</h3>
                    <span class="text-[10px] text-gray-400 font-bold uppercase">Usuario: {{ Auth::user()->rut }}</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">ID / Fecha</th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Descripción del Trámite</th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Departamento</th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Estado</th>
                                <th class="px-6 py-4 text-right text-[10px] font-bold text-gray-400 uppercase tracking-widest">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($solicitudes as $s)
                                <tr class="hover:bg-blue-50/50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-[10px] font-bold text-[#003399]">#{{ str_pad($s->id, 5, '0', STR_PAD_LEFT) }}</div>
                                        <div class="text-[10px] text-gray-400 mt-0.5">{{ $s->created_at->format('d/m/Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('solicitudes.show', $s->id) }}" class="text-sm font-bold text-gray-800 hover:text-[#003399] hover:underline transition decoration-2 underline-offset-4">
                                            {{ $s->titulo }}
                                        </a>
                                        <div class="text-[10px] text-gray-400 mt-1 flex items-center">
                                            @if($s->archivo_path)
                                                <span class="mr-2">📎 Documento adjunto</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-600">
                                        {{ $s->departamento }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $color = [
                                                'Pendiente' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                'Aprobado' => 'bg-green-100 text-green-800 border-green-200',
                                                'Rechazado' => 'bg-red-100 text-red-800 border-red-200'
                                            ][$s->estado] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                        @endphp
                                        <span class="{{ $color }} px-3 py-1 border text-[9px] font-black uppercase tracking-tighter">
                                            {{ $s->estado }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <a href="{{ route('solicitudes.show', $s->id) }}" class="inline-flex items-center p-2 bg-gray-100 hover:bg-[#003399] hover:text-white transition rounded shadow-sm group" title="Ver Expediente">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <span class="text-4xl mb-2">📁</span>
                                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">No se registran trámites en su historial</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($solicitudes->count() > 0)
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        <p class="text-[9px] text-gray-400 italic">Mostrando {{ $solicitudes->count() }} trámite(s) oficial(es) registrado(s) en la plataforma.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

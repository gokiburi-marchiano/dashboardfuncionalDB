<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-[#003399] uppercase tracking-tighter">Mis Trámites y Consultas</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm border border-gray-200">

                @if($solicitudes->isEmpty())
                    <div class="p-10 text-center">
                        <p class="text-gray-500 mb-4">No tiene solicitudes ingresadas en el sistema.</p>
                        <a href="{{ route('solicitudes.create') }}" class="text-[#003399] font-bold hover:underline">Crear Nueva Solicitud</a>
                    </div>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Fecha Ingreso</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Departamento</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Tipo Solicitud</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($solicitudes as $solicitud)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $solicitud->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-[#003399]">
                                    {{ $solicitud->departamento }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="block text-sm font-medium text-gray-800">{{ $solicitud->tipo }}</span>
                                    <span class="text-xs text-gray-500 italic">{{ $solicitud->descripcion }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-[10px] font-black uppercase tracking-wide">
                                        {{ $solicitud->estado }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gob-black uppercase tracking-tighter">
            Gestión Global de Trámites
        </h2>
    </x-slot>

    <div class="bg-white shadow-lg p-6 border-t-4 border-gob-secondary mt-6">
        <p class="mb-4 text-xs text-gob-gray-a">
            Listado completo de solicitudes realizadas por todos los ciudadanos.
        </p>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-[10px] font-bold text-gob-gray-b uppercase">ID / Fecha</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold text-gob-gray-b uppercase">Solicitante</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold text-gob-gray-b uppercase">Trámite</th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold text-gob-gray-b uppercase">Estado</th>
                        <th class="px-6 py-3 text-right text-[10px] font-bold text-gob-gray-b uppercase">Acción</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($solicitudes as $s)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="block text-sm font-bold text-gob-black">#{{ $s->id }}</span>
                            <span class="text-[10px] text-gray-500">{{ $s->created_at->format('d/m/Y') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xs font-bold text-gob-primary">{{ $s->user->name }}</div>
                            <div class="text-[10px] text-gray-500">{{ $s->user->rut }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xs text-gob-black">{{ $s->titulo }}</div>
                            <div class="text-[10px] text-gray-500">{{ $s->departamento }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($s->estado === 'Aprobado')
                                <span class="px-2 py-1 text-[9px] font-black uppercase bg-green-100 text-green-800 rounded">Aprobado</span>
                            @elseif($s->estado === 'Rechazado')
                                <span class="px-2 py-1 text-[9px] font-black uppercase bg-red-100 text-red-800 rounded">Rechazado</span>
                            @else
                                <span class="px-2 py-1 text-[9px] font-black uppercase bg-yellow-100 text-yellow-800 rounded">Pendiente</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <a href="{{ route('solicitudes.show', $s->id) }}" class="text-[10px] font-bold text-gob-primary hover:underline uppercase">
                                Revisar y Evaluar &rarr;
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

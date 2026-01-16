<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gob-black uppercase tracking-tighter">
            Panel de Control Institucional
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="space-y-6">

            <div class="bg-gob-primary text-white p-6 rounded shadow-lg flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold uppercase tracking-wide">Bienvenido, {{ Auth::user()->name }}</h3>
                    <p class="text-xs opacity-80 mt-1">Resumen de actividad y gestión de trámites.</p>
                </div>
                <div class="text-right hidden sm:block">
                    <p class="text-[10px] uppercase font-bold tracking-widest opacity-70">Fecha del Sistema</p>
                    <p class="text-xl font-black">{{ now()->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div class="bg-white p-4 border-l-4 border-yellow-400 shadow-sm rounded-r-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Pendientes</p>
                            <p class="text-2xl font-black text-gob-black">{{ $solicitudesPendientes ?? 0 }}</p>
                        </div>
                        <div class="bg-yellow-100 p-2 rounded-full">
                            <span class="text-xl">⏳</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.solicitudes.index') }}" class="block mt-3 text-[10px] font-bold text-yellow-600 hover:underline uppercase">Revisar &rarr;</a>
                </div>

                <div class="bg-white p-4 border-l-4 border-gob-primary shadow-sm rounded-r-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Recibidas Hoy</p>
                            <p class="text-2xl font-black text-gob-black">{{ $solicitudesHoy ?? 0 }}</p>
                        </div>
                        <div class="bg-blue-100 p-2 rounded-full">
                            <span class="text-xl">📅</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 border-l-4 border-green-500 shadow-sm rounded-r-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Aprobadas</p>
                            <p class="text-2xl font-black text-gob-black">{{ $solicitudesAprobadas ?? 0 }}</p>
                        </div>
                        <div class="bg-green-100 p-2 rounded-full">
                            <span class="text-xl">✅</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 border-l-4 border-gob-gray-a shadow-sm rounded-r-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Ciudadanos</p>
                            <p class="text-2xl font-black text-gob-black">{{ $totalUsuarios ?? 0 }}</p>
                        </div>
                        <div class="bg-gray-100 p-2 rounded-full">
                            <span class="text-xl">👥</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="block mt-3 text-[10px] font-bold text-gob-gray-a hover:underline uppercase">Ver padrón &rarr;</a>
                </div>
            </div>

            <div class="bg-white shadow-md border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-xs font-black text-gob-black uppercase tracking-widest">Últimos Ingresos</h3>
                    <a href="{{ route('admin.solicitudes.index') }}" class="text-[10px] font-bold text-gob-primary hover:underline uppercase">Ver todas</a>
                </div>
                <div class="p-0">
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-gray-100">
                            @forelse($ultimasSolicitudes as $solicitud)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3">
                                    <span class="block text-xs font-bold text-gob-black">{{ $solicitud->titulo }}</span>
                                    <span class="text-[10px] text-gray-500">{{ $solicitud->user->name ?? 'Usuario Eliminado' }}</span>
                                </td>
                                <td class="px-6 py-3">
                                    <span class="block text-[10px] text-gray-400 uppercase">Estado</span>
                                    @if($solicitud->estado == 'Aprobado')
                                        <span class="text-[10px] font-bold text-green-600">APROBADO</span>
                                    @elseif($solicitud->estado == 'Rechazado')
                                        <span class="text-[10px] font-bold text-red-600">RECHAZADO</span>
                                    @else
                                        <span class="text-[10px] font-bold text-yellow-600">PENDIENTE</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <a href="{{ route('solicitudes.show', $solicitud->id) }}" class="text-gob-gray-a hover:text-gob-primary text-xs font-bold uppercase">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-xs text-gray-400">No hay movimientos recientes.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

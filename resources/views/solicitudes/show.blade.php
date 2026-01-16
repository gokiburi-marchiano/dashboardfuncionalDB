<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gob-black uppercase tracking-tighter">
            Expediente Digital #{{ $solicitud->id }}
        </h2>
    </x-slot>

    <div class="space-y-8">

        <div class="bg-white shadow-md border-t-4 border-gob-primary p-6">
            <div class="flex justify-between items-start mb-6 border-b pb-4">
                <div>
                    <h3 class="text-lg font-bold text-gob-primary uppercase">Detalle del Trámite</h3>
                    <p class="text-xs text-gray-500">Información general y documentos adjuntos.</p>
                </div>
                <div class="text-right">
                    @if($solicitud->estado === 'Aprobado')
                        <span class="px-3 py-1 text-[10px] font-black uppercase rounded bg-green-100 text-green-800 border border-green-200">Aprobado</span>
                    @elseif($solicitud->estado === 'Rechazado')
                        <span class="px-3 py-1 text-[10px] font-black uppercase rounded bg-red-100 text-red-800 border border-red-200">Rechazado</span>
                    @else
                        <span class="px-3 py-1 text-[10px] font-black uppercase rounded bg-yellow-100 text-yellow-800 border border-yellow-200">En Revisión</span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <div>
                        <span class="block text-[10px] font-bold text-gob-gray-b uppercase">Título del Trámite</span>
                        <span class="text-sm font-medium text-gob-black">{{ $solicitud->titulo }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-gob-gray-b uppercase">Solicitante</span>
                        <span class="text-sm font-medium text-gob-black">{{ $solicitud->user_rut }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-gob-gray-b uppercase">Departamento</span>
                        <span class="text-sm font-medium text-gob-black">{{ $solicitud->departamento }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-gob-gray-b uppercase">Descripción / Observación</span>
                        <p class="text-sm text-gray-600 italic">{{ $solicitud->descripcion ?? 'Sin observaciones.' }}</p>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-gob-gray-b uppercase">Última Actualización</span>
                        <span class="text-sm font-medium text-gob-black">{{ $solicitud->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>

                <div class="bg-gray-50 p-5 border border-gray-200 rounded-sm">
                    <span class="block text-[10px] font-bold text-gob-gray-b uppercase mb-3">
                        Archivos Adjuntos ({{ $solicitud->archivos->count() }})
                    </span>

                    @if($solicitud->archivos->count() > 0)
                        <div class="space-y-2 mb-4 max-h-60 overflow-y-auto pr-1">
                            @foreach($solicitud->archivos as $archivo)
                                <div class="flex items-center justify-between bg-white p-3 border border-gray-300 shadow-sm rounded hover:bg-gray-50 transition">
                                    <div class="flex items-center gap-2 overflow-hidden">
                                        <span class="text-lg">📄</span>
                                        <div class="flex flex-col min-w-0">
                                            <span class="text-xs font-bold text-gray-700 truncate block" title="{{ $archivo->original_name }}">
                                                {{ $archivo->original_name }}
                                            </span>
                                            <span class="text-[9px] text-gray-400">
                                                {{ $archivo->created_at->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>

                                    <a href="{{ Storage::url($archivo->file_path) }}" target="_blank" class="shrink-0 text-[9px] font-black text-gob-primary uppercase hover:underline bg-blue-50 px-2 py-1 rounded border border-blue-100">
                                        ⬇ Descargar
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-gray-400 italic mb-4 p-4 border border-dashed border-gray-300 rounded text-center">
                            No hay archivos adjuntos en esta solicitud.
                        </p>
                    @endif

                    @if(Auth::id() === $solicitud->user_id && $solicitud->estado !== 'Aprobado')
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <h4 class="text-[10px] font-bold text-gob-secondary uppercase mb-2">
                                ¿Necesitas adjuntar más documentos o corregir?
                            </h4>

                            <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                                @csrf @method('PUT')

                                <input type="file" name="nuevos_archivos[]" multiple required
                                    class="block w-full text-[10px] text-gray-500
                                    file:mr-2 file:py-2 file:px-3 file:border-0
                                    file:text-[10px] file:font-bold
                                    file:bg-gob-primary file:text-white
                                    hover:file:bg-blue-800 cursor-pointer bg-white border border-gray-300 rounded">

                                <button type="submit" class="w-full bg-gob-gray-a text-white text-[10px] font-bold uppercase px-3 py-2 hover:bg-black transition rounded shadow-sm">
                                    Subir Archivos Adicionales
                                </button>
                            </form>
                            <p class="text-[9px] text-gray-400 mt-2 italic text-center">
                                Puedes seleccionar varios archivos (Ctrl + Clic). Se agregarán al expediente.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white shadow-md border border-gray-200 p-6 relative">
            <div class="absolute -top-3 left-6 bg-gob-gray-a text-white px-3 py-1 text-[10px] font-bold uppercase tracking-widest shadow-sm">
                Resolución del Trámite
            </div>

            @if(Auth::user()->role === 'admin')
                <form action="{{ route('admin.solicitudes.evaluar', $solicitud->id) }}" method="POST">
                    @csrf @method('PATCH')

                    <div class="mb-4 mt-2">
                        <label class="block text-[10px] font-bold text-gob-gray-b uppercase mb-2">Observación Oficial del Administrador</label>
                        <textarea name="observacion_admin" rows="3" class="w-full text-xs border-gray-300 focus:border-gob-primary focus:ring-gob-primary shadow-sm rounded-sm" placeholder="Indique las razones de la aprobación o rechazo...">{{ $solicitud->observacion_admin }}</textarea>
                    </div>

                    <div class="flex items-center gap-4 border-t border-gray-100 pt-4">
                        <button type="submit" name="estado" value="Aprobado" class="flex-1 bg-green-600 hover:bg-green-700 text-white text-xs font-black uppercase py-3 rounded shadow-sm transition text-center">
                            ✅ Aprobar Trámite
                        </button>

                        <button type="submit" name="estado" value="Rechazado" class="flex-1 bg-red-600 hover:bg-red-700 text-white text-xs font-black uppercase py-3 rounded shadow-sm transition text-center">
                            🚫 Rechazar Trámite
                        </button>
                    </div>
                </form>

            @else
                <div class="mt-4">
                    @if($solicitud->observacion_admin)
                        <div class="flex gap-4">
                            <div class="shrink-0">
                                @if($solicitud->estado == 'Aprobado')
                                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center border border-green-200">
                                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                @elseif($solicitud->estado == 'Rechazado')
                                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center border border-red-200">
                                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </div>
                                @else
                                    <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center border border-yellow-200">
                                        <span class="text-xl">⏳</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="text-xs font-bold text-gob-black uppercase mb-1">Observación del Funcionario:</h4>
                                <div class="text-sm text-gray-700 bg-gray-50 p-3 border-l-4 border-gray-300 italic">
                                    "{{ $solicitud->observacion_admin }}"
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3 py-2">
                            <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                <span class="text-gray-400">⏳</span>
                            </div>
                            <p class="text-xs text-gray-500 italic">
                                El trámite está siendo revisado. Aún no hay observaciones del administrador.
                            </p>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="relative">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="bg-gray-100 px-3 text-sm font-black text-gob-gray-a uppercase tracking-widest">
                    Historial de Actividad
                </span>
            </div>
        </div>

        <div class="bg-white shadow-sm border border-gray-200 mb-8">
            @if($solicitud->historial && $solicitud->historial->count() > 0)
                <ul class="divide-y divide-gray-100">
                    @foreach($solicitud->historial as $h)
                        <li class="p-4 hover:bg-gray-50 transition">
                            <div class="flex items-center justify-between">
                                <div class="flex items-start gap-3">
                                    <div class="bg-gray-200 p-2 rounded-full">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gob-black uppercase">{{ $h->accion }}</p>
                                        <p class="text-[10px] text-gray-500">
                                            {{ $h->created_at->format('d/m/Y') }} a las {{ $h->created_at->format('H:i') }}
                                        </p>
                                        <p class="text-[10px] text-gob-secondary italic mt-1">
                                            "{{ $h->motivo }}"
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    @if($h->archivo_nuevo)
                                        <a href="{{ Storage::url($h->archivo_nuevo) }}" target="_blank" class="inline-flex items-center px-2 py-1 border border-gray-300 shadow-sm text-[10px] font-bold rounded text-gray-700 bg-white hover:bg-gray-50">
                                            📄 Ver Archivo Subido
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="p-8 text-center">
                    <p class="text-sm text-gray-400 italic">No hay historial de cambios adicionales.</p>
                </div>
            @endif
        </div>

        <div class="mt-4 pb-10">
            <a href="{{ route('solicitudes.index') }}" class="text-xs font-bold text-gob-gray-a hover:text-gob-primary uppercase hover:underline">
                &larr; Volver al listado
            </a>
        </div>
    </div>
</x-app-layout>

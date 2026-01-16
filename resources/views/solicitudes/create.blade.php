<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-[#003399] uppercase tracking-tighter">Nueva Solicitud</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg border-t-4 border-[#003399] p-8">

                <h3 class="text-lg font-bold text-gray-800 mb-6">Seleccione Tipo de Requerimiento</h3>

                <form action="{{ route('solicitudes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">1. Departamento Destino</label>
                        <select name="departamento" class="w-full border-gray-300 focus:border-[#003399] focus:ring-[#003399] p-3 text-sm rounded-md">
                            <option value="RRHH">Recursos Humanos (Personal)</option>
                            <option value="Finanzas">Departamento de Finanzas</option>
                            <option value="Informatica">Soporte TI e Informática</option>
                            <option value="Bienestar">Bienestar y Calidad de Vida</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">2. Tipo de Solicitud</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="cursor-pointer border border-gray-200 p-4 hover:bg-blue-50 hover:border-blue-300 transition flex items-start rounded-md">
                                <input type="radio" name="titulo" value="Feriado Legal" class="mt-1 text-[#003399] focus:ring-[#003399]" required>
                                <div class="ml-3">
                                    <span class="block font-bold text-sm text-gray-700">Feriado Legal</span>
                                    <span class="block text-xs text-gray-500">Solicitud de días de vacaciones anuales.</span>
                                </div>
                            </label>

                            <label class="cursor-pointer border border-gray-200 p-4 hover:bg-blue-50 hover:border-blue-300 transition flex items-start rounded-md">
                                <input type="radio" name="titulo" value="Permiso Administrativo" class="mt-1 text-[#003399] focus:ring-[#003399]">
                                <div class="ml-3">
                                    <span class="block font-bold text-sm text-gray-700">Permiso Administrativo</span>
                                    <span class="block text-xs text-gray-500">Días libres con goce de sueldo (máx 6 al año).</span>
                                </div>
                            </label>

                            <label class="cursor-pointer border border-gray-200 p-4 hover:bg-blue-50 hover:border-blue-300 transition flex items-start rounded-md">
                                <input type="radio" name="titulo" value="Certificado de Antigüedad" class="mt-1 text-[#003399] focus:ring-[#003399]">
                                <div class="ml-3">
                                    <span class="block font-bold text-sm text-gray-700">Certificado de Antigüedad</span>
                                    <span class="block text-xs text-gray-500">Documento para trámites bancarios.</span>
                                </div>
                            </label>

                            <label class="cursor-pointer border border-gray-200 p-4 hover:bg-blue-50 hover:border-blue-300 transition flex items-start rounded-md">
                                <input type="radio" name="titulo" value="Solicitud de Reembolso" class="mt-1 text-[#003399] focus:ring-[#003399]">
                                <div class="ml-3">
                                    <span class="block font-bold text-sm text-gray-700">Solicitud de Reembolso</span>
                                    <span class="block text-xs text-gray-500">Gastos médicos o viáticos.</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">3. Observaciones Adicionales</label>
                        <textarea name="descripcion" rows="3" class="w-full border-gray-300 focus:border-[#003399] focus:ring-[#003399] rounded-md" placeholder="Especifique fechas o detalles necesarios..."></textarea>
                    </div>

                    <div class="mb-8">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">
                            4. Adjuntar Documentos de Respaldo (Opcional, Máx 10)
                        </label>

                        <div class="flex flex-col items-center justify-center w-full">
                            <label for="archivos" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-blue-50 transition-colors relative">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-3 text-[#003399]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-700"><span class="font-bold">Haga clic para subir</span> o arrastre sus archivos aquí</p>
                                    <p class="text-xs text-gray-500">PDF, JPG, DOCX (Máx. 10MB c/u)</p>
                                </div>
                                <input id="archivos" name="archivos[]" type="file" class="hidden" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" />
                            </label>

                            <div id="lista-archivos" class="w-full mt-4 space-y-2"></div>
                        </div>

                        <p class="mt-2 text-xs text-center text-gray-400">
                            Mantenga presionada la tecla <span class="font-bold">Ctrl</span> (o Cmd) para seleccionar varios archivos a la vez.
                        </p>

                        @error('archivos')
                            <span class="text-red-500 text-xs block mt-1 font-bold">{{ $message }}</span>
                        @enderror
                        @error('archivos.*')
                            <span class="text-red-500 text-xs block mt-1 font-bold">Uno de los archivos tiene un formato no válido o es muy pesado.</span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-[#003399] hover:bg-blue-800 text-white font-bold py-3 px-6 uppercase tracking-widest text-xs transition shadow-md rounded">
                            Ingresar Solicitud
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputArchivos = document.getElementById('archivos');
            const listaArchivos = document.getElementById('lista-archivos');

            if(inputArchivos) {
                inputArchivos.addEventListener('change', function(e) {
                    listaArchivos.innerHTML = '';

                    const files = Array.from(inputArchivos.files);

                    if (files.length > 0) {
                        const titulo = document.createElement('p');
                        titulo.className = 'text-xs font-bold text-gray-500 mb-2 border-b pb-1';
                        titulo.innerText = `Archivos seleccionados (${files.length}):`;
                        listaArchivos.appendChild(titulo);

                        files.forEach(file => {
                            const item = document.createElement('div');
                            item.className = 'flex items-center justify-between p-3 bg-blue-50 border border-blue-100 rounded text-sm text-gray-700 shadow-sm';

                            let icon = '📄';
                            if(file.name.match(/\.(jpg|jpeg|png)$/i)) icon = '🖼️';
                            if(file.name.match(/\.(pdf)$/i)) icon = '📕';
                            if(file.name.match(/\.(doc|docx)$/i)) icon = '📝';

                            item.innerHTML = `
                                <div class="flex items-center gap-3 overflow-hidden">
                                    <span class="text-xl">${icon}</span>
                                    <span class="truncate font-medium text-blue-900">${file.name}</span>
                                </div>
                                <span class="text-xs text-gray-500 whitespace-nowrap bg-white px-2 py-1 rounded border">
                                    ${(file.size / 1024 / 1024).toFixed(2)} MB
                                </span>
                            `;
                            listaArchivos.appendChild(item);
                        });
                    }
                });
            }
        });
    </script>
</x-app-layout>

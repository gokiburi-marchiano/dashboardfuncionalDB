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
                        <select name="departamento" class="w-full border-gray-300 focus:border-[#003399] focus:ring-[#003399] p-3 text-sm">
                            <option value="RRHH">Recursos Humanos (Personal)</option>
                            <option value="Finanzas">Departamento de Finanzas</option>
                            <option value="Informatica">Soporte TI e Informática</option>
                            <option value="Bienestar">Bienestar y Calidad de Vida</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">2. Tipo de Solicitud</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="cursor-pointer border border-gray-200 p-4 hover:bg-blue-50 hover:border-blue-300 transition flex items-start">
                                <input type="radio" name="titulo" value="Feriado Legal" class="mt-1 text-[#003399] focus:ring-[#003399]" required>
                                <div class="ml-3">
                                    <span class="block font-bold text-sm text-gray-700">Feriado Legal</span>
                                    <span class="block text-xs text-gray-500">Solicitud de días de vacaciones anuales.</span>
                                </div>
                            </label>

                            <label class="cursor-pointer border border-gray-200 p-4 hover:bg-blue-50 hover:border-blue-300 transition flex items-start">
                                <input type="radio" name="titulo" value="Permiso Administrativo" class="mt-1 text-[#003399] focus:ring-[#003399]">
                                <div class="ml-3">
                                    <span class="block font-bold text-sm text-gray-700">Permiso Administrativo</span>
                                    <span class="block text-xs text-gray-500">Días libres con goce de sueldo (máx 6 al año).</span>
                                </div>
                            </label>

                            <label class="cursor-pointer border border-gray-200 p-4 hover:bg-blue-50 hover:border-blue-300 transition flex items-start">
                                <input type="radio" name="titulo" value="Certificado de Antigüedad" class="mt-1 text-[#003399] focus:ring-[#003399]">
                                <div class="ml-3">
                                    <span class="block font-bold text-sm text-gray-700">Certificado de Antigüedad</span>
                                    <span class="block text-xs text-gray-500">Documento para trámites bancarios.</span>
                                </div>
                            </label>

                            <label class="cursor-pointer border border-gray-200 p-4 hover:bg-blue-50 hover:border-blue-300 transition flex items-start">
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
                        <textarea name="descripcion" rows="3" class="w-full border-gray-300 focus:border-[#003399] focus:ring-[#003399]" placeholder="Especifique fechas o detalles necesarios..."></textarea>
                    </div>

                    <div class="mb-8 p-4 bg-gray-50 border border-dashed border-gray-300 rounded">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">4. Adjuntar Documento de Respaldo (Opcional)</label>
                        <div class="flex items-center">
                            <input type="file" name="archivo" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-xs file:font-bold
                                file:bg-[#003399] file:text-white
                                hover:file:bg-blue-800
                                cursor-pointer"
                            />
                        </div>
                        <p class="mt-2 text-xs text-gray-400">Formatos permitidos: PDF, JPG, Word. Máximo 10MB.</p>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-[#003399] hover:bg-blue-800 text-white font-bold py-3 px-6 uppercase tracking-widest text-xs transition shadow-md">
                            Ingresar Solicitud
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

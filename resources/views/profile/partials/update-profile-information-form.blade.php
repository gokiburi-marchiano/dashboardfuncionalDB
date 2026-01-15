<section>
    <header>
        <h2 class="text-lg font-bold text-[#003399] uppercase tracking-tight">
            Ficha del Funcionario
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Actualice su información de contacto y datos institucionales.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="rut" :value="__('RUT (Identificador)')" class="text-xs uppercase font-bold text-gray-500 tracking-widest" />
                <x-text-input id="rut" name="rut" type="text" class="mt-1 block w-full bg-gray-100 cursor-not-allowed" :value="old('rut', $user->rut)" readonly />
            </div>

            <div>
                <x-input-label for="email" :value="__('Correo Electrónico')" class="text-xs uppercase font-bold text-gray-500 tracking-widest" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div class="md:col-span-2">
                <x-input-label for="name" :value="__('Nombres')" class="text-xs uppercase font-bold text-gray-500 tracking-widest" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="apellido_paterno" :value="__('Apellido Paterno')" class="text-xs uppercase font-bold text-gray-500 tracking-widest" />
                <x-text-input id="apellido_paterno" name="apellido_paterno" type="text" class="mt-1 block w-full" :value="old('apellido_paterno', $user->apellido_paterno)" />
            </div>

            <div>
                <x-input-label for="apellido_materno" :value="__('Apellido Materno')" class="text-xs uppercase font-bold text-gray-500 tracking-widest" />
                <x-text-input id="apellido_materno" name="apellido_materno" type="text" class="mt-1 block w-full" :value="old('apellido_materno', $user->apellido_materno)" />
            </div>

            <div class="md:col-span-2">
                <x-input-label for="direccion" :value="__('Dirección Particular')" class="text-xs uppercase font-bold text-gray-500 tracking-widest" />
                <x-text-input id="direccion" name="direccion" type="text" class="mt-1 block w-full" :value="old('direccion', $user->direccion)" placeholder="Ej: Av. Libertador Bernardo O'Higgins 1234" />
            </div>

            <div>
                <x-input-label for="telefono" :value="__('Teléfono de Contacto')" class="text-xs uppercase font-bold text-gray-500 tracking-widest" />
                <x-text-input id="telefono" name="telefono" type="text" class="mt-1 block w-full" :value="old('telefono', $user->telefono)" placeholder="+56 9 ..." />
            </div>

            <div>
                <x-input-label for="cargo" :value="__('Cargo / Función')" class="text-xs uppercase font-bold text-gray-500 tracking-widest" />
                <x-text-input id="cargo" name="cargo" type="text" class="mt-1 block w-full" :value="old('cargo', $user->cargo)" placeholder="Ej: Analista de Sistemas" />
            </div>

            <div class="md:col-span-2">
                 <x-input-label for="unidad" :value="__('Unidad o Departamento')" class="text-xs uppercase font-bold text-gray-500 tracking-widest" />
                 <select id="unidad" name="unidad" class="mt-1 block w-full border-gray-300 focus:border-[#003399] focus:ring-[#003399] rounded-md shadow-sm">
                    <option value="">Seleccione una unidad...</option>
                    <option value="Finanzas" {{ old('unidad', $user->unidad) == 'Finanzas' ? 'selected' : '' }}>Departamento de Finanzas</option>
                    <option value="RRHH" {{ old('unidad', $user->unidad) == 'RRHH' ? 'selected' : '' }}>Recursos Humanos</option>
                    <option value="Juridica" {{ old('unidad', $user->unidad) == 'Juridica' ? 'selected' : '' }}>División Jurídica</option>
                    <option value="Informatica" {{ old('unidad', $user->unidad) == 'Informatica' ? 'selected' : '' }}>Tecnologías de la Información</option>
                 </select>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="bg-[#003399] hover:bg-blue-800 text-white font-black py-2 px-6 uppercase tracking-widest text-xs transition">
                Guardar Ficha
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-bold"
                >
                    {{ __('Datos actualizados correctamente.') }}
                </p>
            @endif
        </div>
    </form>
</section>

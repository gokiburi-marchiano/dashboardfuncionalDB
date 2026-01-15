<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-gray-800 uppercase tracking-tight">Registro de Usuario</h2>
        <p class="text-sm text-gray-600">Cree su cuenta institucional</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" value="Nombre Completo" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="rut" value="RUT" />
            <x-text-input id="rut" class="block mt-1 w-full" type="text" name="rut" :value="old('rut')" placeholder="12.345.678-k" required />
            <x-input-error :messages="$errors->get('rut')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Clave Única" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmar Clave Única" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-blue-800 hover:underline" href="{{ route('login') }}">
                ¿Ya tiene cuenta? Inicie sesión
            </a>

            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#003399] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 transition ease-in-out duration-150">
                Registrar
            </button>
        </div>
    </form>
</x-guest-layout>

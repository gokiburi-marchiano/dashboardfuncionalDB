<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="flex justify-center mb-4">
            <div class="w-16 h-1 bg-blue-900"></div>
            <div class="w-16 h-1 bg-red-600"></div>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Acceso Institucional</h2>
        <p class="text-sm text-gray-600">Inicie sesión con su RUT y Clave Única</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="rut" value="RUT" class="font-semibold text-gray-700" />
            <x-text-input id="rut" class="block mt-1 w-full border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm"
                         type="text" name="rut" :value="old('rut')"
                         placeholder="12.345.678-9" required autofocus />
            <x-input-error :messages="$errors->get('rut')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Clave Única" class="font-semibold text-gray-700" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm"
                         type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-4 mt-6">
            <x-primary-button class="w-full justify-center bg-[#003399] hover:bg-[#002266] py-3 text-lg font-bold">
                {{ __('Ingresar') }}
            </x-primary-button>

            <div class="relative flex py-3 items-center">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="flex-shrink mx-4 text-gray-400 text-xs uppercase tracking-widest">o</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <a href="{{ route('register') }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-white border border-[#003399] rounded-md font-semibold text-sm text-[#003399] uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                Solicitar Acceso / Registro
            </a>
        </div>

        @if (Route::has('password.request'))
            <div class="text-center mt-4">
                <a class="text-sm text-gray-600 hover:text-blue-900 underline" href="{{ route('password.request') }}">
                    ¿Problemas con su Clave Única?
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>

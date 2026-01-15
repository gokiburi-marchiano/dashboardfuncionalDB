<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your rut address and we will rut you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.rut') }}">
        @csrf

        <!-- rut Address -->
        <div>
            <x-input-label for="rut" :value="__('rut')" />
            <x-text-input id="rut" class="block mt-1 w-full" type="rut" name="rut" :value="old('rut')" required autofocus />
            <x-input-error :messages="$errors->get('rut')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('rut Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

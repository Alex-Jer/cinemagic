<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo"> </x-slot>

        <div class="text-center text-2xl font-bold text-gray-800 dark:text-gray-200">
            CineMagic
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-600 dark:border-gray-600"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Lembrar-me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300"
                        href="{{ route('password.request') }}">
                        Esqueceu-se da palavra-passe?
                    </a>
                @endif

                <x-button class="ml-3">
                    Iniciar Sessão
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

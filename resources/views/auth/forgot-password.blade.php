<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo"></x-slot>

        <div class="mb-4 text-2xl font-bold text-center text-gray-800 dark:text-gray-200">
            CineMagic
        </div>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Esqueceu-se da sua palavra-passe? Não há problema. Basta que nos indique o seu endereço de email e enviar-lhe-emos por
            email um link de redefinição de palavra-passe.
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    Redefinir palavra-passe
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

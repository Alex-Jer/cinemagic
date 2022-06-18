<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo"></x-slot>

        <div class="text-center text-2xl font-bold text-gray-800 dark:text-gray-200">
            CineMagic
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation"
                    required />
            </div>

            <!-- Upload Picture -->
            <div class="mt-4">
                <x-label for="profile_pic" :value="__('Profile Picture')" />
                <input type="file"
                    class="block w-full transition border border-gray-300 border-solid input-primary bg-clip-padding"
                    id="profile_pic" name="profile_pic">
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="text-sm text-gray-600 underline hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300"
                    href="{{ route('login') }}">
                    Já tem uma conta?
                </a>

                <x-button class="ml-4">
                    Registar
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

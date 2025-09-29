<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Facebook Button: centrado y con colores Facebook -->
        <div class="mt-4 d-flex justify-content-center">
            <a href="{{ route('auth.redirect') }}"
            class="btn w-100"
            style="background-color: #1877f2; color: #fff; border: none; height: 48px; font-weight: 600; display: flex; align-items: center; justify-content: center; border-radius: 2rem;">
            <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:8px" width="24" height="24" fill="white" viewBox="0 0 320 512"><path d="M279.14 288l14.22-92.66h-88.91V127.78c0-25.35 12.42-50.06 52.24-50.06H293V6.26S259.5 0 225.36 0c-73.22 0-121 44.38-121 124.72V195.3H22.89V288h81.47v224h100.2V288z"/></svg>
            Iniciar Sesión con Facebook
        </a>
    </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-black hover:text-gray-900" href="{{ route('login') }}">
                ¿Ya tienes una cuenta?
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
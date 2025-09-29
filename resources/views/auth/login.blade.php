<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4 d-flex justify-content-center">
            <a href="{{ route('auth.redirect') }}"
            class="btn w-100"
            style="background-color: #1877f2; color: #fff; border: none; height: 48px; font-weight: 600; display: flex; align-items: center; justify-content: center; border-radius: 2rem;">
            <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:8px" width="24" height="24" fill="white" viewBox="0 0 320 512"><path d="M279.14 288l14.22-92.66h-88.91V127.78c0-25.35 12.42-50.06 52.24-50.06H293V6.26S259.5 0 225.36 0c-73.22 0-121 44.38-121 124.72V195.3H22.89V288h81.47v224h100.2V288z"/></svg>
            Iniciar Sesión con Facebook
        </a>
    </div>

        <!-- Remember Me -->
        <div class="block mt-4">
           <label for="remember_me" class="inline-flex items-center">
    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
    <span class="ms-2 text-sm text-black">{{ __('Recordarme') }}</span>
</label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-black hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" 
                          class="block mt-1 w-full focus:ring-2 focus:ring-[#FC4C00] focus:border-[#FC4C00]"
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required 
                          autofocus 
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Пароль')" />
            <x-text-input id="password" 
                          class="block mt-1 w-full focus:ring-2 focus:ring-[#FC4C00] focus:border-[#FC4C00]"
                          type="password"
                          name="password"
                          required 
                          autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" 
                       type="checkbox" 
                       class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 
                              text-[#FC4C00] shadow-sm focus:ring-[#FC4C00] focus:ring-offset-2 
                              dark:focus:ring-offset-gray-800 transition-colors duration-200" 
                       name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400 transition-colors duration-200">
                    {{ __('Запомнить меня') }}
                </span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 
                         hover:text-gray-900 dark:hover:text-gray-100 rounded-md 
                         focus:outline-none focus:ring-2 focus:ring-[#FC4C00] focus:ring-offset-2 
                         transition-colors duration-200" 
                   href="{{ route('password.request') }}">
                    {{ __('Забыли пароль?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-[#FC4C00] hover:bg-[#e04300] text-white 
                                   focus:ring-2 focus:ring-[#FC4C00] focus:ring-offset-2 
                                   transition-colors duration-200">
                {{ __('Войти') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
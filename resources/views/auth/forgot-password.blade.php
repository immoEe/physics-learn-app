<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 transition-colors duration-200">
        {{ __('Забыли пароль? Не проблема. Укажите ваш email, и мы вышлем ссылку для сброса пароля.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
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
                          autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bg-[#FC4C00] hover:bg-[#e04300] text-white focus:ring-2 
                              focus:ring-[#FC4C00] focus:ring-offset-2 transition-colors duration-200">
                {{ __('Отправить ссылку для сброса') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
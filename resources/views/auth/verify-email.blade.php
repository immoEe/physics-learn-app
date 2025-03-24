<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 transition-colors duration-200">
        {{ __('Спасибо за регистрацию! Перед началом работы подтвердите ваш email, перейдя по ссылке в письме. Если письмо не пришло, мы вышлем новое.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 transition-colors duration-200">
            {{ __('Новая ссылка для подтверждения была отправлена на ваш email.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <x-primary-button class="bg-[#FC4C00] hover:bg-[#e04300] text-white 
                                   focus:ring-2 focus:ring-[#FC4C00] focus:ring-offset-2 
                                   transition-colors duration-200">
                    {{ __('Отправить письмо повторно') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 
                           rounded-md focus:outline-none focus:ring-2 focus:ring-[#FC4C00] focus:ring-offset-2 
                           transition-colors duration-200 px-4 py-2 border border-transparent hover:border-gray-300">
                {{ __('Выйти') }}
            </button>
        </form>
    </div>
</x-guest-layout>
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 transition-colors duration-200">
        {{ __('Это защищенная зона приложения. Пожалуйста, подтвердите ваш пароль перед продолжением.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Пароль')" />
            <x-text-input id="password" 
                          class="block mt-1 w-full focus:ring-2 focus:ring-[#FC4C00] focus:border-[#FC4C00]"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button class="bg-[#FC4C00] hover:bg-[#e04300] text-white focus:ring-2 
                                  focus:ring-[#FC4C00] focus:ring-offset-2 transition-colors duration-200">
                {{ __('Подтвердить') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
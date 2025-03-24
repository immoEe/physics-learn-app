<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" 
                          class="block mt-1 w-full focus:ring-2 focus:ring-[#FC4C00] focus:border-[#FC4C00]"
                          type="email" 
                          name="email" 
                          :value="old('email', $request->email)" 
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
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Подтвердите пароль')" />
            <x-text-input id="password_confirmation" 
                          class="block mt-1 w-full focus:ring-2 focus:ring-[#FC4C00] focus:border-[#FC4C00]"
                          type="password"
                          name="password_confirmation" 
                          required 
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bg-[#FC4C00] hover:bg-[#e04300] text-white 
                               focus:ring-2 focus:ring-[#FC4C00] focus:ring-offset-2 
                               transition-colors duration-200">
                {{ __('Сбросить пароль') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<x-guest-layout>
    <div class="flex flex-col items-center justify-center h-full p-8">

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <!-- Validation Errors -->
        <x-auth.validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />
            </div>

            <x-button fullWidth="true">{{ __('Confirm') }}</x-button>
        </form>
    </div>
</x-guest-layout>

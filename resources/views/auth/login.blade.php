<x-guest-layout>
    <div class="flex flex-col items-center justify-center h-full p-8">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form class="md:w-1/3" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="flex items-center justify-center">
                <x-button color="blue" fullWidth="true">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>

                    <div class="relative leading-none">
                        <span class="inline-block w-0 h-3 align-baseline"></span>
                        <span class="relative font-semibold">Entrar com o Facebook</span>
                    </div>
                </x-button>
            </div>

            <div class="my-4 text-center text-gray-500">ou</div>

            <x-input id="email" type="email" name="email" placeholder="E-mail" :value="old('email')" required autofocus />

            <x-input id="password" type="password" class="my-4" name="password" placeholder="Senha" required autocomplete="current-password" />

            <x-button fullWidth="true">
                {{ __('Entrar') }}
            </x-button>

            <div class="flex flex-col items-center justify-center gap-4 mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-center text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                @if (Route::has('register'))
                    <a class="text-sm text-center text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                        Não é registrado? Cadastre-se
                    </a>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>

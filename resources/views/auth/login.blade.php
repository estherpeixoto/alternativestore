<x-guest-layout>
    <div class="flex flex-col items-center justify-center h-full p-8">

        <form class="sm:w-1/2 md:w-1/3 2xl:w-1/4" method="POST" action="{{ route('login') }}">
            @csrf
			<x-title class="mb-10 text-xl">Fazer login</x-title>

            <div class="flex items-center justify-center">
                <x-button color="blue" fullWidth="true">
                    <x-facebook-logo class="mr-1" />

                    <div class="relative leading-none">
                        <span class="inline-block w-0 h-3 align-baseline"></span>
                        <span class="relative text-sm font-semibold normal-case">Entrar com o Facebook</span>
                    </div>
                </x-button>
            </div>

            <div class="my-4 text-center text-gray-500">ou</div>

            <x-input id="email" type="email" name="email" placeholder="E-mail" :value="old('email')" required autofocus />

            <x-input id="password" type="password" class="my-4" name="password" placeholder="Senha" required autocomplete="current-password" />

			<x-auth.session-status class="mb-4" :status="session('status')" />

            <x-button fullWidth="true">{{ __('Entrar') }}</x-button>

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

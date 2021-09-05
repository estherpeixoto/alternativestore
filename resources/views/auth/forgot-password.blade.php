<x-guest-layout>
    <div class="flex flex-col items-center justify-center h-full p-8">
        <div class="md:w-1/3">
			<x-title class="text-xl">Esqueci minha senha</x-title>

            <div class="mb-8 text-sm text-gray-600">
                Informe seu e-mail cadastrado e receba as instruções para recuperar sua senha
            </div>

            <x-auth.session-status class="mb-4" :status="session('status')" />
            <x-auth.validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <x-input id="email" class="block w-full" type="email" name="email" :value="old('email')" placeholder="E-mail" required autofocus />

                <x-button class="my-4" fullWidth="true">Enviar</x-button>

				<a class="block text-sm text-center text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
					Voltar para o login
				</a>
            </form>
        </div>
    </div>
</x-guest-layout>

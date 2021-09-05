<x-guest-layout>
    <div class="flex flex-col items-center justify-center flex-1 p-8">
        <form class="md:w-1/3" method="POST" action="{{ route('register') }}">
            @csrf
			<x-title class="mb-10 text-xl">Criar conta</x-title>

            <div class="mb-4">
				<x-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Nome" />
			</div>

			<div class="mb-4">
				<x-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required placeholder="E-mail" />
			</div>

			<div class="mb-4">
				<x-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" placeholder="Senha" />
			</div>

			<div class="mb-4">
				<x-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required placeholder="Confirmar senha" />
			</div>

			<div class="mb-4">
				<x-input id="cpf" class="block w-full" type="text" name="cpf" :value="old('cpf')" maxlength="14" required placeholder="CPF" />
			</div>

			<div class="mb-4">
				<x-input id="telephone" class="block w-full" type="text" name="telephone" :value="old('telephone')" maxlength="16" required placeholder="Telefone" />
			</div>

            <x-button class="mb-4" fullWidth="true">Criar conta</x-button>

            <a class="block text-sm text-center text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }} Fazer login
            </a>
        </form>
    </div>
</x-guest-layout>

<script src="{{ asset('js\RobinHerbots-Inputmask\inputmask.min.js') }}"></script>

<script>
    Inputmask({
        mask: '999.999.999-99',
    }).mask(document.getElementById('cpf'));

    Inputmask({
        mask: '(99) 9 9999-9999',
    }).mask(document.getElementById('telephone'));
</script>
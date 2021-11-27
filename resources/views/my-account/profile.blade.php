<x-app-layout>

	{{-- <x-slot name='breadcrumbs'>
		{{ Breadcrumbs::render('users.form', $user->name ?? '') }}
	</x-slot> --}}

	<x-slot name="header">
		{{ __('Dados') }}
	</x-slot>

	<form method="POST" action="/dashboard/minha-conta{{ isset($account['id']) ? "/" . $account['id'] : '' }}">
		@csrf

		@method('PUT')

		<div>
			<x-label for="name" :value="__('Nome')" />
			<x-input id="name"
				type="text"
				name="name"
				value="{{ isset($account['nome']) ? $account['nome'] : ''}}"
				placeholder="Nome completo"
				maxlength="50"
				required
				autofocus
			/>
		</div>

		<div class="mt-5">
			<x-label for="email" :value="__('E-mail')" />
			<x-input id="email"
				type="text"
				name="email"
				value="{{ isset($account['email']) ? $account['email'] : '' }}"
				placeholder="seu.email@email.com"
				maxlength="255"
				required
			/>
		</div>

		<div class="mt-5">
			<x-label for="cpf" :value="__('CPF')" />
			<x-input id="cpf"
				type="text"
				name="cpf"
				value="{{ isset($account['cpf']) ? $account['cpf'] : '' }}"
				placeholder="000.000.000-00"
				maxlength="11"
				required
				data-inputmask="'mask': '999.999.999-99'"
			/>
		</div>

		<div class="mt-5">
			<x-label for="telephone" :value="__('Telefone')" />
			<x-input id="telephone"
				type="text"
				name="telephone"
				value="{{ isset($account['telefone']) ? $account['telefone'] : '' }}"
				placeholder="(00) 0 0000-0000"
				required
			/>
		</div>

		<x-admin.submit action="{{ $action ?? 'alterar' }}" />
	</form>
</x-app-layout>

<script src="https://raw.githubusercontent.com/RobinHerbots/Inputmask/5.x/dist/inputmask.min.js"></script>

<script>
	var selector = document.getElementById("telephone");

	var im = new Inputmask("(99) 99999-9999");
	console.log(im)
	im.mask(selector);
</script>

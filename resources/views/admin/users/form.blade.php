<x-app-layout>
	<x-slot name='breadcrumbs'>
		{{ Breadcrumbs::render('users.form', $user->name ?? '') }}
	</x-slot>

	<x-slot name="header">
		{{ __('Usuários') }}
	</x-slot>

	<form method="POST" action="/dashboard/usuarios{{ isset($user->id) ? "/$user->id" : '' }}">
		@csrf

		@if (isset($action))
			@if ($action == 'alterar')
				@method('PUT')
			@elseif ($action == 'excluir')
				@method('DELETE')
			@endif
		@endif

		<div>
			<x-label for="name" :value="__('Nome')" />
			<x-input id="name"
				type="text"
				name="name"
				value="{{ old('name') ?? $user->name ?? '' }}"
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
				value="{{ old('email') ?? $user->email ?? '' }}"
				placeholder="seu.email@email.com"
				maxlength="255"
				required
			/>
		</div>

		<div class="mt-5">
			<x-label for="password" :value="__('Senha')" />
			<x-input id="password"
				type="password"
				name="password"
				value="{{ old('password') ?? $user->password ?? '' }}"
				required
			/>
		</div>

		<div class="mt-5">
			<x-label for="cpf" :value="__('CPF')" />
			<x-input id="cpf"
				type="text"
				name="cpf"
				value="{{ old('cpf') ?? $user->cpf ?? '' }}"
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
				value="{{ old('telephone') ?? $user->telephone ?? '' }}"
				placeholder="(00) 0 0000-0000"
				maxlength="11"
				required
			/>
		</div>

		<x-admin.submit action="{{ $action ?? 'cadastrar' }}" />
	</form>
</x-app-layout>
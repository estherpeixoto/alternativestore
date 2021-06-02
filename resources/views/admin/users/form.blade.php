<x-app-layout>
	<x-slot name="header">
		{{ __('Usuários') }}
	</x-slot>

	<div class="overflow-x-auto">
		<form method="POST" action="{{ route('user.create') }}">
			@csrf

			<div>
				<x-label for="name" :value="__('Nome')" />

				<x-input id="name"
					class="block mt-1 w-full"
					type="text"
					name="name"
					:value="old('name')"
					placeholder="Nome completo"
					required
					autofocus
				/>
			</div>

			<div class="mt-5">
				<x-label for="email" :value="__('E-mail')" />

				<x-input id="email"
					class="block mt-1 w-full"
					type="text"
					name="email"
					:value="old('email')"
					placeholder="seu.email@email.com"
					required
				/>
			</div>

			<div class="mt-5">
				<x-label for="password" :value="__('Senha')" />

				<x-input id="password"
					class="block mt-1 w-full"
					type="password"
					name="password"
					:value="old('password')"
					required
				/>
			</div>

			<div class="mt-5">
				<x-label for="cpf" :value="__('CPF')" />

				<x-input id="cpf"
					class="block mt-1 w-full"
					type="text"
					name="cpf"
					:value="old('cpf')"
					placeholder="000.000.000-00"
					required
				/>
			</div>

			<div class="mt-5">
				<x-label for="telephone" :value="__('Telefone')" />

				<x-input id="telephone"
					class="block mt-1 w-full"
					type="text"
					name="telephone"
					:value="old('telephone')"
					placeholder="(00) 0 0000-0000"
					required
				/>
			</div>

			<div class="flex items-center justify-end mt-5">
				<x-button color="blue">
					{{ __('Cadastrar') }}
				</x-button>
			</div>
		</form>
	</div>
</x-app-layout>
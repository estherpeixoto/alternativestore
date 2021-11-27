<x-guest-layout>
    <x-container>
		<x-title class="text-xl">Minha conta</x-title>

		<a href='/minha-conta/pedidos'>Meus pedidos</a>
		<a href="{{route('dados')}}">Meus dados</a>

		<form method="POST" action="{{ route('logout') }}">
			@csrf
			<button type="submit" href='/logout'>Sair</button>
		</form>
    </x-container>
</x-guest-layout>

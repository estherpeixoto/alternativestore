<header x-data="{ open: false }">
	<nav class="bg-white sm:ml-60">

		<!-- Primary Navigation Menu -->
		<div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
			<div class="flex justify-between h-16">

				<!-- Hamburger -->
				<div class="flex items-center sm:hidden">
					<button @click="open = ! open" class="inline-flex items-center justify-center transition duration-150 ease-in-out focus:outline-none">
						<svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
							<path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
							<path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
				</div>

				<!-- Settings Dropdown -->
				<div class="flex items-center ml-6 sm:ml-auto">
					<x-dropdown align="right" width="48">
						<x-slot name="trigger">
							<button class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
								<div>{{ Auth::user()->name }}</div>

								<div class="ml-1">
									<svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
										<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
									</svg>
								</div>
							</button>
						</x-slot>

						<x-slot name="content">
							<!-- Authentication -->
							<form method="POST" action="{{ route('logout') }}">
								@csrf

								<x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
									{{ __('Log out') }}
								</x-dropdown-link>
							</form>
						</x-slot>
					</x-dropdown>
				</div>
			</div>
		</div>
	</nav>

	<!-- Responsive Navigation Menu -->
	<aside :class="{'block': open, 'hidden': ! open}" class="fixed top-0 left-0 z-30 h-full p-6 overflow-auto transform bg-gray-700 sm:block w-60">
		<!-- Logo -->
		<div class='flex justify-between mb-8 text-gray-50'>
			<a class="flex items-center flex-shrink-0" href="{{ route('dashboard') }}">
				<x-application-logo class="block w-auto h-3 fill-current" />
			</a>

			<button @click="open = ! open" class="sm:hidden">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
				</svg>
			</button>
		</div>

		<x-responsive-nav-link :href="route('home')">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
			  </svg>
			{{ __('Voltar para a loja') }}
		</x-responsive-nav-link>

		@if (Auth::user()->type != 'C')
		<x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
			</svg>
			{{ __('Dashboard') }}
		</x-responsive-nav-link>

		<x-responsive-nav-link :href="route('order.list')" :active="request()->routeIs('order.list')">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
			</svg>
			{{ __('Pedidos') }}
		</x-responsive-nav-link>

		<x-navigation.nav-group>
			<x-slot name='title'>Cadastros</x-slot>

			<x-responsive-nav-link :href="route('product.list')" :active="request()->routeIs('product.list')">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
				</svg>
				{{ __('Produtos') }}
			</x-responsive-nav-link>

			<x-responsive-nav-link :href="route('category.list')" :active="request()->routeIs('category.list')">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
				</svg>
				{{ __('Categorias') }}
			</x-responsive-nav-link>

			<x-responsive-nav-link :href="route('size.list')" :active="request()->routeIs('size.list')">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
				</svg>
				{{ __('Tamanhos') }}
			</x-responsive-nav-link>

			<x-responsive-nav-link :href="route('user.list')" :active="request()->routeIs('user.list')">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
				</svg>
				{{ __('Usuários') }}
			</x-responsive-nav-link>
		</x-navigation.nav-group>
		@endif

		<x-navigation.nav-group>
			<x-slot name='title'>Configurações</x-slot>

			<x-responsive-nav-link :href="route('minha-conta')" :active="request()->routeIs('minha-conta')">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
				{{ __('Minha conta') }}
			</x-responsive-nav-link>

			<x-responsive-nav-link :href="route('trocar-senha')" :active="request()->routeIs('trocar-senha')">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.960-5.960A6 6 0 1121 9z" />
				</svg>
				{{ __('Trocar senha') }}
			</x-responsive-nav-link>
		</x-navigation.nav-group>
	</aside>
</header>
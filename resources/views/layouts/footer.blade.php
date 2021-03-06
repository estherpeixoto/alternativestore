
<footer class="text-gray-600 body-font">
    <div class="flex flex-col flex-wrap justify-center px-8 py-5 mx-auto lg:items-center lg:flex-row lg:justify-between lg:flex-nowrap">
		<a class="hidden lg:block" href="/">
            <x-application-logo
                class="block w-auto h-3.5 fill-current text-center"
            />
        </a>

        <ul class="flex flex-col flex-wrap justify-center gap-4 text-xs text-center uppercase list-none sm:flex-row">
			@auth
				@if (Auth::user()->type == 'A')
					<li>
						<a href="/dashboard" class="text-gray-600 hover:text-gray-800">Dashboard</a>
					</li>
				@else
					<li>
						<a href="/minha-conta" class="text-gray-600 hover:text-gray-800">Minha conta</a>
					</li>
				@endif
			@else
				<li>
					<a href="/register" class="text-gray-600 hover:text-gray-800">Cadastre-se</a>
				</li>

				<li>
					<a href="/login" class="text-gray-600 hover:text-gray-800">Login</a>
				</li>
			@endauth

            <li>
                <a href="/sobre-nos" class="text-gray-600 hover:text-gray-800">Sobre nós</a>
            </li>

            <li>
                <a href="/contato" class="text-gray-600 hover:text-gray-800">Contato</a>
            </li>

            <li>
                <a href="/entrega" class="text-gray-600 hover:text-gray-800">Entrega & Retorno</a>
            </li>

            <li>
                <a href="/termos" class="text-gray-600 hover:text-gray-800">Termos</a>
            </li>

            <li>
                <a href="/politica" class="text-gray-600 hover:text-gray-800">Política</a>
            </li>
        </ul>
    </div>

    <div class="bg-gray-100">
        <div class="flex flex-col flex-wrap px-8 py-4 mx-auto sm:flex-row">
            <p class="text-xs text-center text-gray-500 sm:text-left">© 2021, ALTERNATIVE STORE. TODOS OS DIREITOS RESERVADOS.</p>

            <span class="inline-flex justify-center mt-2 sm:ml-auto sm:mt-0 sm:justify-start">
                <a class="text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>

                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </a>

                <a class="ml-3 text-gray-500">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>

                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                        <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                        <circle cx="4" cy="4" r="2" stroke="none"></circle>
                    </svg>
                </a>
            </span>
        </div>
    </div>
</footer>

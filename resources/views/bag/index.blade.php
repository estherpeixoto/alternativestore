<x-guest-layout>
    <x-container class="mb-8">
        @if ($products)
            <x-products.wizard active="1" />

            {{-- <x-title class="my-8 text-xl">Sacola</x-title> --}}

            <div class="flex flex-col gap-8 md:flex-row">
                <aside class="md:w-2/3">
                    @foreach ($products as $product)
                        <div class="flex items-center gap-4 pb-2 mb-2 border-b border-gray-100">
                            <form method='POST' action='/sacola/remover/{{ $product->id }}'>
								@csrf
								@method('DELETE')

								<button type='submit'>
									<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
									</svg>
								</button>
							</form>

                            <a class="w-3/4 md:w-2/5" href="/">
                                <img src="{{ asset("/storage/products/$product->image") }}" />
                            </a>

                            <div class="flex flex-col w-full">
                                <a href="/" class="text-sm text-gray-500">{{ $product->title }}</a>

                                <p class="font-semibold text-gray-900">R$ {{ number_format($product->price, 2, ',', '.') }}</p>

                                <div class="flex flex-col justify-between gap-3 mt-3 md:flex-row lg:mt-6">
                                    <select data-type='size' @change="handleSubmit($event, {{ $product->id }})"
                                        class="py-1 pl-2 pr-8 text-sm text-gray-500 transition-colors duration-200 ease-in-out bg-transparent border border-gray-300 rounded outline-none focus:ring-0 focus:border-gray-300 focus:bg-gray-50 w-min">
                                        @foreach ($sizes as $size)
											<option value="{{ $size->id }}" {{ $size->id == $product->size_id ? 'selected' : '' }}>{{ $size->description }}</option>
										@endforeach
                                    </select>

                                    <div class="flex border border-gray-300 rounded-md w-min">
                                        <button
                                            class="p-1 text-xs text-center text-gray-500 transition duration-150 ease-in-out bg-transparent border-r border-gray-300 focus:outline-none rounded-l-md hover:bg-gray-50 focus:border-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>

										<input class="items-center w-10 px-3 py-1 text-xs font-semibold text-center text-gray-500" value="{{ $product->quantity }}" />

                                        <button
                                            class="p-1 text-xs text-center text-gray-500 transition duration-150 ease-in-out bg-transparent border-l border-gray-300 focus:outline-none rounded-r-md hover:bg-gray-50 focus:border-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </aside>

                <aside class="flex flex-col gap-4 p-8 bg-gray-50 md:w-1/3">
                    <h6 class="text-lg font-semibold text-gray-900">Resumo do pedido</h6>

                    <p class="flex justify-between text-sm text-gray-900 uppercase">
                        Subtotal:
                        <span>R$ <?= number_format($subtotal, 2, ',', '.') ?></span>
                    </p>

                    <p class="flex justify-between text-sm text-gray-900 uppercase">
						Entrega:
						<span>R$ <?= number_format($entrega, 2, ',', '.') ?></span>
                    </p>

                    <p class="flex justify-between text-sm font-semibold text-gray-900 uppercase">
                        Total:
                        <span>R$ <?= number_format($subtotal + $entrega, 2, ',', '.') ?></span>
                    </p>

					<x-button href='/sacola/entrega'>
						Continuar
						<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
						</svg>
					</x-button>
                </aside>
            </div>
        @else
            Sua sacola está vazia
        @endif
    </x-container>
</x-guest-layout>

<x-alert-modal />

<script src="{{ asset('js/bag.js') }}"></script>
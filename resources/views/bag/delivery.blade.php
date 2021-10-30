<x-guest-layout>
    <x-container class="mb-8">
        <x-products.wizard active="2" />

        <x-title class="my-8 text-xl">Dados de entrega</x-title>

        <form method="post"
            action="/sacola/entrega"
            class="flex flex-col gap-8 md:flex-row">
            @csrf

			<input name="city[ibge]" value="{{ $address->ibge }}" type="hidden" />

            <aside class="md:w-2/3">
                <div class="col-span-1">
                    <x-label for="postal_code"
                        :value="__('CEP')" />

                    <x-input id="postal_code"
                        type="text"
                        name="postal_code"
                        maxlength="9"
                        value="{{ $address->postal_code ?? (old('postal_code') ?? '') }}"
                        required
                        autofocus />
                </div>

                <div class="grid grid-cols-5 gap-4">
                    <div class="col-span-4 mt-5">
                        <x-label for="street"
                            :value="__('Logradouro')" />

                        <x-input id="street"
                            type="text"
                            name="street"
                            maxlength="80"
                            value="{{ $address->street ?? (old('street') ?? '') }}"
                            required />
                    </div>

                    <div class="col-span-1 mt-5">
                        <x-label for="number"
                            :value="__('Número')" />

                        <x-input id="number"
                            type="text"
                            name="number"
                            value="{{ $address->number ?? (old('number') ?? '') }}"
                            required />
                    </div>
                </div>

                <div class="mt-5">
                    <x-label for="complement"
                        :value="__('Complemento')" />

                    <x-input id="complement"
                        type="text"
                        name="complement"
                        maxlength="45"
                        value="{{ $address->complement ?? (old('complement') ?? '') }}" />
                </div>

                <div class="col-span-1 mt-5">
                    <x-label for="neighbour"
                        :value="__('Bairro')" />

                    <x-input id="neighbour"
                        type="text"
                        name="neighbour"
                        maxlength="45"
                        value="{{ $address->neighbour ?? (old('neighbour') ?? '') }}"
                        required />
                </div>

                <div class="grid grid-cols-5 gap-4">
                    <div class="col-span-4 mt-5">
                        <x-label for="city"
                            :value="__('Cidade')" />

                        <x-input id="city"
                            type="text"
                            name="city[description]"
                            maxlength="45"
                            value="{{ $address->city ?? (old('city.description') ?? '') }}"
                            required />
                    </div>

                    <div class="col-span-1 mt-5">
                        <x-label for="state"
                            :value="__('Estado')" />

                        <x-input id="state"
                            type="text"
                            name="state"
                            maxlength="2"
                            value="{{ $address->state ?? (old('state') ?? '') }}"
                            required />
                    </div>
                </div>

                <div class="flex justify-between mt-5">
                    <a href='/sacola'
                        class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>

                        Voltar para sacola
                    </a>

                    <x-button class="gap-1">
                        Ir para o pagamento

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </x-button>
                </div>
            </aside>

            <aside class="flex flex-col gap-4 p-8 bg-gray-50 md:w-1/3">
                <h6 class="text-lg font-semibold text-gray-900">Resumo do pedido</h6>

                <p class="flex justify-between text-sm text-gray-900 uppercase">
                    Subtotal:
                    <span>R$ <?= number_format($price_products, 2, ',', '.') ?></span>
                </p>

                <p class="flex justify-between text-sm text-gray-900 uppercase">
                    Entrega:
                    <span>R$ <?= number_format($price_delivery, 2, ',', '.') ?></span>
                </p>

                <p class="flex justify-between text-sm font-semibold text-gray-900 uppercase">
                    Total:
                    <span>R$ <?= number_format($price_products + $price_delivery, 2, ',', '.') ?></span>
                </p>
            </aside>
        </form>
    </x-container>
</x-guest-layout>

<x-alert-modal />

<script src="{{ asset('js/bag.js') }}"></script>
<script src="{{ asset('js/RobinHerbots-Inputmask/inputmask.min.js') }}"></script>
<script>
    let postalCode = document.getElementById('postal_code');

    Inputmask({
        mask: '#####-###'
    }).mask(postalCode);

	postalCode.addEventListener('keyup', function(event) {
		const street = document.getElementById('street')
		const complement = document.getElementById('complement')
		const neighbour = document.getElementById('neighbour')
		const city = document.getElementById('city')
		const state = document.getElementById('state')

		if (event.target.value.replaceAll('_', '').length === 9) {
			fetch(`https://viacep.com.br/ws/${event.target.value}/json/`, {
				mode: 'cors',
			}).then(response => {
				response.json().then(r => {
					if (r.erro === true) {
						changeModal({
							state: 'error',
							title: 'Erro',
							description: 'Houve um erro. CEP não encontrado.',
							secondaryButtonText: 'Voltar',
						})

						show()

						postalCode.value = ''
					} else {
						complement.value = r.complemento

						street.value = r.logradouro
						street.setAttribute('readonly', true)

						neighbour.value = r.bairro
						neighbour.setAttribute('readonly', true)

						city.value = r.localidade
						city.setAttribute('readonly', true)
						document.querySelector("input[name^='city[ibge]']").value = r.ibge

						state.value = r.uf
						state.setAttribute('readonly', true)

						document.getElementById('number').focus()
					}
				})
			})
		} else {
			complement.value = ''

			street.value = ''
			street.setAttribute('readonly', false)

			neighbour.value = ''
			neighbour.setAttribute('readonly', false)

			city.value = ''
			city.setAttribute('readonly', false)

			state.value = ''
			state.setAttribute('readonly', false)
		}
	})
</script>

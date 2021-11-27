<x-guest-layout>
    <x-container class="mb-8">
        <x-products.wizard page="2" />

        <x-title class="my-8 text-xl">Dados de entrega</x-title>

        <form method="post" action="/sacola/entrega" class="flex flex-col h-full gap-8 md:flex-row">
            @csrf

            <input name="city[ibge]" value="{{ $address->ibge ?? '' }}" type="hidden" />

            <aside class="md:w-2/3">
                <div class="col-span-1">
                    <x-label for="postal_code" :value="__('CEP')" />

                    <x-input id="postal_code" type="text" name="postal_code" maxlength="9"
                        value="{{ $address->postal_code ?? (old('postal_code') ?? '') }}" required autofocus />
                </div>

                <div class="grid grid-cols-5 gap-4">
                    <div class="col-span-4 mt-5">
                        <x-label for="street" :value="__('Logradouro')" />

                        <x-input id="street" type="text" name="street" maxlength="80"
                            value="{{ $address->street ?? (old('street') ?? '') }}" required />
                    </div>

                    <div class="col-span-1 mt-5">
                        <x-label for="number" :value="__('Número')" />

                        <x-input id="number" type="text" name="number"
                            value="{{ $address->number ?? (old('number') ?? '') }}" required />
                    </div>
                </div>

                <div class="mt-5">
                    <x-label for="complement" :value="__('Complemento')" />

                    <x-input id="complement" type="text" name="complement" maxlength="45"
                        value="{{ $address->complement ?? (old('complement') ?? '') }}" />
                </div>

                <div class="col-span-1 mt-5">
                    <x-label for="neighbour" :value="__('Bairro')" />

                    <x-input id="neighbour" type="text" name="neighbour" maxlength="45"
                        value="{{ $address->neighbour ?? (old('neighbour') ?? '') }}" required />
                </div>

                <div class="grid grid-cols-5 gap-4">
                    <div class="col-span-4 mt-5">
                        <x-label for="city" :value="__('Cidade')" />

                        <x-input id="city" type="text" name="city[description]" maxlength="45"
                            value="{{ $address->city ?? (old('city.description') ?? '') }}" required />
                    </div>

                    <div class="col-span-1 mt-5">
                        <x-label for="state" :value="__('Estado')" />

                        <x-input id="state" type="text" name="state" maxlength="2"
                            value="{{ $address->state ?? (old('state') ?? '') }}" required />
                    </div>
                </div>
            </aside>

            <aside class="flex flex-col gap-4 p-8 bg-gray-50 md:w-1/3">
                <h6 class="text-lg font-semibold text-gray-900">Resumo do pedido</h6>

                <p class="flex justify-between text-sm text-gray-900 uppercase">
                    Subtotal:
                    <span>R$ <?= $totals->price_products ?></span>
                </p>

                <p class="flex justify-between text-sm text-gray-900 uppercase">
                    Entrega:
                    <span>R$ <?= $totals->price_delivery ?></span>
                </p>

                <p class="flex justify-between text-sm font-semibold text-gray-900 uppercase">
                    Total:
                    <span>R$ <?= $totals->total ?></span>
                </p>

                <x-button type="submit" class="gap-1">
                    Ir para o pagamento
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-auto" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </x-button>

                <a href="/sacola" class="p-4 text-xs font-semibold tracking-widest text-center text-gray-500 uppercase focus:outline-none">
                    Voltar
                </a>
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

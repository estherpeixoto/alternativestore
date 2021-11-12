<x-guest-layout>
    <x-container class="mb-8">
        <x-products.wizard active="3" />

        <x-title class="my-8 text-xl">Dados de entrega</x-title>

        <form method="post" action="/sacola/entrega" class="flex flex-col h-full gap-8 md:flex-row">
            @csrf

            <aside class="md:w-2/3">
                <div class="flex justify-between mt-5">
                    <a href="/sacola" class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>

                        Voltar para sacola
                    </a>

                    <x-button id="submit" type="button" onclick="checkout()" class="gap-1">CONFIRMAR DADOS</x-button>
                </div>
            </aside>

            <aside class="flex flex-col gap-4 p-8 bg-gray-50 md:w-1/3">
                <h6 class="text-lg font-semibold text-gray-900">Resumo do pedido</h6>

                <p class="flex justify-between text-sm text-gray-900 uppercase">
                    Subtotal:
                    <span id="price_products">R$ <?= $totals->price_products ?></span>
                </p>

                <p class="flex justify-between text-sm text-gray-900 uppercase">
                    Entrega:
                    <span id="price_delivery">R$ <?= $totals->price_delivery ?></span>
                </p>

                <p class="flex justify-between text-sm font-semibold text-gray-900 uppercase">
                    Total:
                    <span id="total">R$ <?= $totals->total ?></span>
                </p>
            </aside>
        </form>
    </x-container>
</x-guest-layout>

<x-alert-modal />

<script src="{{ asset('js/bag/http.js') }}"></script>
<script src="{{ asset('js/bag/payment.js') }}"></script>

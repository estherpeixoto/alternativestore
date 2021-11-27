<x-guest-layout>
    <x-container class="mb-8">
        <x-products.wizard page="3" />

        <x-title id="title" class="my-8 text-xl">Método de pagamento</x-title>

        <form method="post" action="/sacola/entrega" class="flex flex-col h-full gap-8 md:flex-row">
            @csrf

            <aside class="md:w-2/3">
                <fieldset id="picpay_description" class="p-5 mt-6 border border-gray-200 rounded-md">
                    <div class="flex items-center justify-between mb-4">
                        <label for="ticket" class="flex items-center gap-2 cursor-pointer">
                            <img src="{{ asset('images/icons/picpay.png') }}" />
                            <span>PicPay</span>
                        </label>

                        <input id="ticket" type="radio" name="paymentMethod" checked required />
                    </div>

                    <blockquote class="pl-2 text-gray-500 border-l-8 border-gray-200">
                        Pague com PicPay direto do seu celular.
                        Ao finalizar a compra, um código será exibido.<br class="hidden md:block">
                        Para pagar, basta escanear o código com seu PicPay.
                    </blockquote>
                </fieldset>

                <fieldset id="picpay_qrcode" class="hidden pt-8">
                    <div class="flex flex-col justify-center gap-4">
                        <div>
                            <h3 class="text-xl font-semibold text-center text-gray-900">
                                Pague com PicPay
                            </h3>

                            <p class="mt-4 text-center text-gray-500">
                                Abra o PicPay em seu telefone e<br class="hidden md:block">escaneie o código abaixo:
                            </p>

                            <div class="m-6 p-0.5 border border-green-300 max-w-full mx-auto sm:w-1/3">
                                <img src="" />
                            </div>

                            <a target="_blank" class="block text-xs text-center text-gray-700" href="">
                                Abrir aplicativo
                            </a>
                        </div>
                    </div>
                </fieldset>

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

                <x-button id="submit" type="button" onclick="checkout()" class="gap-1">
                    Finalizar pedido
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-auto" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </x-button>

                <a href="/sacola/entrega" class="p-4 text-xs font-semibold tracking-widest text-center text-gray-500 uppercase focus:outline-none">
                    Voltar
                </a>
            </aside>
        </form>
    </x-container>
</x-guest-layout>

<x-alert-modal />

<script src="{{ asset('js/bag/http.js') }}"></script>
<script src="{{ asset('js/bag/payment.js') }}"></script>

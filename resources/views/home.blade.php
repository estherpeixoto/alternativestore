<x-guest-layout>
    <div class='flex flex-col flex-1 {{ $products ? '' : 'items-center justify-center gap-4' }}'>
        @if ($products)
            <x-container fullHeight="">
                <div class="grid grid-cols-1 gap-4 mb-20 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($products as $product)
                        <x-products.product-item image="{{ $product->image }}" title="{{ $product->title }}" category="{{ $product->category }}" price="{{ $product->price }}" />
                    @endforeach
                </div>
            </x-container>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>

            <p class="text-xl font-medium text-gray-700">Sem resultados para a pesquisa</p>
            <p class="text-gray-500">Você procurou por: {{ $category ?? $search }}</p>
        @endif
    </div>
</x-guest-layout>

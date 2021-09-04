<x-guest-layout>
    <x-container>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
			@foreach ($products as $product)
				<x-products.product-item
					image="{{ $product->image }}"
					title="{{ $product->title }}"
					category="{{ $product->category }}"
					price="{{ $product->price }}"
				/>
			@endforeach
		</div>
    </x-container>
</x-guest-layout>

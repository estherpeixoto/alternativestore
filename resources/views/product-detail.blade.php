@php
	$imagesData = json_encode([
		'activeImage' => (int) $productImages[0]->id,
		'images' => $productImages
	], JSON_UNESCAPED_SLASHES);

	$sizesData = json_encode([
		'selectedSize' => -1,
		'sizes' => $sizes
	], JSON_UNESCAPED_SLASHES);
@endphp

<x-guest-layout>
    <x-container>
        <div class="grid h-full grid-cols-1 md:-ml-8 md:grid-cols-3">
            <aside class="flex items-center col-span-2">
                <div class="relative w-full h-full md:pr-8"
					x-data='{{ $imagesData }}'
					x-init="$watch('activeImage', value => console.log(value, images.length))"
				>
                    <!-- Images -->
                    <template x-for="image in images" :key="image.id">
                        <img x-show="activeImage === image.id"
							:src="image.filename"
							class="object-contain h-full mx-auto transition-all duration-150 ease-in-out rounded-lg md:px-24"
						/>
                    </template>

                    <!-- Prev/Next Arrows -->
                    <div class="absolute inset-0 flex">
                        <div class="flex items-center justify-start w-1/2">
                            <button class="w-12 h-12 -ml-6 md:m-6 focus:outline-none"
								x-on:click="activeImage = (activeImage === 0 ? images.length : activeImage - 1)"
							>
                                <svg xmlns="http://www.w3.org/2000/svg"
									class="w-full h-full transition-opacity duration-150 ease-in-out opacity-10 hover:opacity-25"
									fill="none"
									viewBox="0 0 24 24"
									stroke="currentColor"
								>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                        </div>

                        <div class="flex items-center justify-end w-1/2">
                            <button class="w-12 h-12 -mr-6 md:m-6 focus:outline-none"
								x-on:click="activeImage = (activeImage === images.length - 1 ? 0 : activeImage + 1)"
							>
                                <svg xmlns="http://www.w3.org/2000/svg"
									class="w-full h-full transition-opacity duration-150 ease-in-out opacity-10 hover:opacity-25"
									fill="none"
									viewBox="0 0 24 24"
									stroke="currentColor"
								>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </aside>

            <aside class="mt-5 md:mt-8">
                <h1 class="text-2xl font-medium text-gray-900 uppercase">{{ $product->title }}</h1>
                <h2 class="text-xl text-gray-900">R$ {{ number_format($product->price, 2, ',', '.') }}</h2>

				<form method="POST" action="/carrinho/adicionar">
					@csrf

					<input type="hidden" name="product" value={{ $product->id }} />

					<section class="my-8">
						<span class="text-sm font-medium text-gray-600">Selecionar tamanho</span>

						<div class="flex gap-4 my-4"
							x-data='{{ $sizesData }}'
							x-init="$watch('selectedSize', size => console.log(size))"
						>
							<!-- Images -->
							<template x-for="size in sizes" :key="size.id">
								<div class='flex-grow'>
									<input :id="'size_' + size.id"
										name="selectedSize"
										:value="size.id"
										type="radio"
										class="hidden"
										x-model="selectedSize"
										required
									/>

									<label :for="'size_' + size.id"
										x-text="size.description"
										:class="{ 'font-semibold border-gray-800': selectedSize == size.id, 'font-medium text-gray-500 border-gray-100': selectedSize != size.id }"
										class="block px-4 py-2 text-sm tracking-widest text-center uppercase transition duration-150 ease-in-out border rounded-md cursor-pointer"
									></label>
								</div>
							</template>
						</div>

						<a href="#" class="flex gap-1.5 text-gray-600 font-medium text-sm hover:underline hover:text-gray-900 transition-colors duration-150 ease-in-out">
							<img src="{{ asset('images/icons/ruler.svg') }}" />
							Orientações de tamanho
						</a>
					</section>

					<x-button fullWidth="true">
						<div class="flex items-center">
							<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
							</svg>
							<span class="font-bold -mb-0.5">Adicionar a sacola</span>
						</div>
					</x-button>
				</form>

                <section class="mt-8">
                    <div class="flex items-center mb-4">
                        <span class="mr-1 text-sm font-medium text-gray-600">Detalhes</span>

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <div class="text-sm text-gray-500">{!! $product->description !!}</div>
                </section>
            </aside>
        </div>
    </x-container>
</x-guest-layout>

@props(['image', 'title', 'category', 'price'])

<div class="text-center">
    <a href="/produtos/{{ strtolower($category) }}/{{ strtolower(str_replace(' ', '-', $title)) }}">
		<img class="block object-cover object-center w-auto rounded" src="{{ asset("/storage/products/$image") }}" />

        <h5 class="mt-3 font-medium text-gray-500">{{ $title }}</h5>

        <span class="block font-semibold text-gray-800">
            R$ {{ number_format($price, 2, ',', '.') }}
        </span>
    </a>
</div>

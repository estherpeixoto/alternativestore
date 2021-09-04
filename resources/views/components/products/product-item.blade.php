@props(['image', 'title', 'category', 'price'])

<div class="">
	<img src="{{ asset("/storage/products/$image") }}" />

	<h5>{{ $title }}</h5>
	{{-- <h6>{{ $category }}</h6> --}}
	<span>{{ $price }}</span>
</div>
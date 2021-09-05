@props(['disabled' => false])

<input
	{{ $disabled ? 'disabled' : '' }}
	{!! $attributes->merge([
		'class' => 'w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:bg-white text-base outline-none text-gray-700 py-1.5 px-3 leading-8 transition-colors duration-200 ease-in-out'
	]) !!}
/>

@error($attributes['name'])
    <small class='text-red-500 mt-3.5'>{{ $message }}</small>
@enderror
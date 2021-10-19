@props(['color' => 'dark', 'fullWidth' => "false"])

@php
switch ($color) {
    case 'blue':
        $btnColor = 'text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-600 focus:border-blue-600 ring-blue-200';
        break;
    case 'red':
        $btnColor = 'text-white bg-red-500 hover:bg-red-700 active:bg-red-900 focus:border-red-900 ring-red-200';
        break;
    case 'outline-gray':
        $btnColor = 'text-gray-700 bg-transparent hover:bg-gray-700 active:bg-gray-900 focus:border-gray-900 hover:text-white ring-gray-200';
        break;
    default:
        $btnColor = 'text-white bg-gray-800 hover:bg-gray-700 active:bg-gray-900 focus:border-gray-900 ring-gray-200';
        break;
}
@endphp

@if (isset($attributes['href']))
<a {{ $attributes->merge([
	'class' => ($fullWidth == "true" ? '' : 'sm:w-auto ') . "inline-flex items-center justify-center w-full px-4 py-4 text-xs font-semibold tracking-widest uppercase transition duration-150 ease-in-out border border-transparent rounded-md focus:ring focus:outline-none disabled:opacity-25 $btnColor"
	]) }}
>
    {{ $slot }}
</a>
@else
<button {{ $attributes->merge([
	'type' => 'submit',
	'class' => ($fullWidth == "true" ? '' : 'sm:w-auto ') . "inline-flex items-center justify-center w-full px-4 py-4 text-xs font-semibold tracking-widest uppercase transition duration-150 ease-in-out border border-transparent rounded-md focus:ring focus:outline-none disabled:opacity-25 $btnColor"
	]) }}
>
    {{ $slot }}
</button>
@endif

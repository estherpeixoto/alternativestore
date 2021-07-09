@props(["color"])

@php
switch ($color) {
    case "blue":
        $btnColor = "bg-blue-500 hover:bg-blue-600 active:bg-blue-600 focus:border-blue-600";
        break;
    case "red":
        $btnColor = "bg-red-500 hover:bg-red-700 active:bg-red-900 focus:border-red-900";
        break;
    default:
        $btnColor = "bg-gray-800 hover:bg-gray-700 active:bg-gray-900 focus:border-gray-900";
        break;
}
@endphp

<button {{ $attributes->merge([
	"type" => "submit",
	"class" => "w-full sm:w-auto inline-flex items-center justify-center px-4 py-4 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:ring focus:outline-none disabled:opacity-25 transition ease-in-out duration-150 $btnColor"
	]) }}
>
    {{ $slot }}
</button>

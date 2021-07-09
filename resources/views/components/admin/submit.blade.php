@props(["action"])

@php
switch ($action) {
    case "excluir":
        $btnColor = "red";
        break;
   default:
        $btnColor = "blue";
        break;
}
@endphp

<div class="flex items-center justify-end mt-5">
	<x-button color="{{ $btnColor }}">
		{{ $action }}
	</x-button>
</div>
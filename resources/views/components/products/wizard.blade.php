@props(['page' => 1])

@php

$data = [
	'page' => $page,
	'steps' => [
		['id' => 1, 'description' => 'Carrinho'],
		['id' => 2, 'description' => 'Entrega'],
		['id' => 3, 'description' => 'Pagamento']
	],
];

@endphp

{{-- Wizard --}}
<div class="flex justify-center gap-6 sm:border-b sm:border-gray-200" x-data='{{ json_encode($data) }}'>
	{{-- Steps --}}
	<template x-for="step in steps" :key="step.id">
		<div class="flex items-center gap-2 pb-2 -mb-px text-sm font-semibold" :class="{ 'border-b border-gray-900': page == step.id }">
			<span class="flex items-center justify-center w-6 h-6 text-white rounded-full" x-text="step.id" :class="{ 'bg-gray-900': page == step.id, 'bg-gray-400': page != step.id }"></span>
			<span class="uppercase" x-text="step.description" :class="{ 'text-gray-900': page == step.id, 'text-gray-400': page != step.id }"></span>
		</div>
	</template>
</div>

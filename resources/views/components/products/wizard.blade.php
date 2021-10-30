@props(['active' => 1])

{{-- Wizard --}}
<div class="flex justify-center gap-6 sm:border-b sm:border-gray-200"
	x-data='{
		"page": {{ $active }},
		"active": {{ $active }},
		"steps": [
			{ "id": 1, "description": "Carrinho", "showOnly": [1, 2] },
			{ "id": 2, "description": "Entrega", "showOnly": [2, 3] },
			{ "id": 3, "description": "Pagamento", "showOnly": [2, 3] }
		]
	}'
	x-init="$watch('active', a => console.log(a))"
>
	{{-- Steps --}}
	<template x-for="step in steps" :key="step.id">
		<div class="flex items-center gap-2 pb-2 -mb-px text-sm font-semibold"
			@click="active = step.id <= page ? step.id : active;"
			:class="{
				'border-b border-gray-900': active == step.id,
				'': active != step.id,
				'cursor-pointer': step.id <= page
			}"
		>
			<span class="flex items-center justify-center w-6 h-6 text-white rounded-full"
				x-text="step.id"
				:class="{
					'bg-gray-900': active == step.id,
					'bg-gray-400': active != step.id
				}"
			></span>

			<span class="uppercase"
				x-text="step.description"
				:class="{
					'hidden': !step.showOnly.includes(active),
					'block': step.showOnly.includes(active),
					'text-gray-900': active == step.id,
					'text-gray-400': active != step.id
				}"
			></span>
		</div>
	</template>
</div>
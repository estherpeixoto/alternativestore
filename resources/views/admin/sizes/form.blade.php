<x-app-layout>
	<x-slot name='breadcrumbs'>
		{{ Breadcrumbs::render('sizes.form', $size->description ?? '') }}
	</x-slot>

	<x-slot name="header">
		{{ __('Tamanhos') }}
	</x-slot>

	<form method="POST" action="/dashboard/tamanhos{{ isset($size->id) ? "/$size->id" : '' }}">
		@csrf

		@if (isset($action))
			@if ($action == 'alterar')
				@method('PUT')
			@elseif ($action == 'excluir')
				@method('DELETE')
			@endif
		@endif

		<div>
			<x-label for="description" :value="__('Descrição')" />
			<x-input id="description"
				type="text"
				name="description"
				value="{{ old('description') ?? $size->description ?? '' }}"
				maxlength="3"
				required
				autofocus
			/>
		</div>

		<x-admin.submit action="{{ $action ?? 'cadastrar' }}" />
	</form>
</x-app-layout>
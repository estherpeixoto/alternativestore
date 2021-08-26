<x-app-layout>
	<x-slot name='breadcrumbs'>
		{{ Breadcrumbs::render('categories.form', $category->description ?? '') }}
	</x-slot>

	<x-slot name="header">
		{{ __('Usuários') }}
	</x-slot>

	<form method="POST" action="/dashboard/categorias{{ isset($category->id) ? "/$category->id" : '' }}">
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
				value="{{ old('description') ?? $category->description ?? '' }}"
				maxlength="50"
				required
				autofocus
			/>
		</div>

		<x-admin.submit action="{{ $action ?? 'cadastrar' }}" />
	</form>
</x-app-layout>
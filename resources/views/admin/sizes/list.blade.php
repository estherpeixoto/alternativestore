<x-app-layout>
	<x-slot name='breadcrumbs'>
		{{ Breadcrumbs::render('sizes.index') }}
	</x-slot>

	<x-slot name='header'>
		{{ __('Tamanhos') }}
	</x-slot>

	<table id='table' class='w-full bg-white border divide-y divide-gray-300 whitespace-nowrap'>
		<thead class='bg-gray-50'>
			<tr class='text-sm leading-normal text-gray-600 uppercase bg-gray-200'>
				<th class='px-6 py-3 text-left'>Descrição</th>
				<th class='px-6 py-3 text-center'>Opções</th>
			</tr>
		</thead>

		<tbody class='text-sm text-gray-600'>
			@foreach ($sizes as $size)
				<tr class='border-b border-gray-200 hover:bg-gray-100'>
					<td class='px-6 py-4 font-medium'>{{ $size->description }}</td>
					<td class='px-6 py-4 text-center'>
						<x-admin.crud-options :id='$size->id' />
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</x-app-layout>
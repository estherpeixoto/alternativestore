<x-app-layout>
	<x-slot name='breadcrumbs'>
		{{ Breadcrumbs::render('users.index') }}
	</x-slot>

	<x-slot name='header'>
		{{ __('Usuários') }}
	</x-slot>

	<table id='table' class='w-full bg-white border divide-y divide-gray-300 whitespace-nowrap'>
		<thead class='bg-gray-50'>
			<tr class='text-sm leading-normal text-gray-600 uppercase bg-gray-200'>
				<th class='px-6 py-3 text-left'>Nome</th>
				<th class='px-6 py-3 text-left'>E-mail</th>
				<th class='px-6 py-3 text-center'>Telefone</th>
				<th class='px-6 py-3 text-center'>Opções</th>
			</tr>
		</thead>

		<tbody class='text-sm text-gray-600'>
			@foreach ($users as $user)
				<tr class='border-b border-gray-200 hover:bg-gray-100'>
					<td class='px-6 py-4 font-medium'>{{ $user->name }}</td>
					<td class='px-6 py-4'>{{ $user->email }}</td>
					<td class='px-6 py-4'>{{ $user->phoneNumber($user->telephone) }}</td>
					<td class='px-6 py-4 text-center'>
						<x-admin.crud-options :id='$user->id' />
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</x-app-layout>
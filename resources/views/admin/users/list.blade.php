<x-app-layout>
	<x-slot name="header">
		{{ __('Usuários') }}
	</x-slot>

	<div class="flex flex-wrap justify-between mb-3">
		<div class="order-1">
			<label for="results" class="mr-3">Resultados: </label>
			<select id="results" name="results" class="py-2 rounded focus:outline-none border-gray-200 focus:border-gray-300 transition duration-150 ease-in-out">
				<option>10</option>
				<option>20</option>
				<option>30</option>
			</select>
		</div>

		<div class="w-full lg:w-auto lg:ml-auto lg:mr-3 mt-4 lg:mt-0 order-3 lg:order-2 relative text-gray-400 focus-within:text-gray-500 transition duration-150 ease-in-out">
			<span class="absolute inset-y-0 left-0 flex items-center pl-2">
				<button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
					<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
						<path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
					</svg>
				</button>
			</span>

			<input class="w-full pl-11 py-2 border rounded focus:outline-none border-gray-200 focus:border-gray-300" placeholder="Procurar..." />
		</div>

		<a href='/dashboard/usuarios/incluir' class="order-2 lg:order-3 bg-blue-500 hover:bg-blue-600 transition duration-150 ease-in-out rounded-md p-2">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
			</svg>
		</a>
	</div>

	<div class="overflow-x-auto">
		<table class="w-full whitespace-nowrap shadow rounded-lg bg-white divide-y divide-gray-300 overflow-hidden">
			<thead class="bg-gray-50">
				<tr class="text-gray-600 text-left">
					<th class="font-semibold text-sm uppercase px-6 py-4">Nome</th>
					<th class="font-semibold text-sm uppercase px-6 py-4">E-mail</th>
					<th class="font-semibold text-sm uppercase px-6 py-4 text-center">Opções</th>
				</tr>
			</thead>

			<tbody class="divide-y divide-gray-200">
				<tr>
					<td class="px-6 py-4">Esther Peixoto</td>
					<td class="px-6 py-4">estherpeixoto13@gmail.com</td>
					<td class="px-6 py-4 text-center">
						<a href='/dashboard/usuarios/1/alterar'>Alterar</a>
						<a href='/dashboard/usuarios/1/excluir'>Excluir</a>
					</td>
				</tr>
				<tr>
					<td class="px-6 py-4">Esther Peixoto</td>
					<td class="px-6 py-4">estherpeixoto13@gmail.com</td>
					<td class="px-6 py-4 text-center">
						<a href='/dashboard/usuarios/1/alterar'>Alterar</a>
						<a href='/dashboard/usuarios/1/excluir'>Excluir</a>
					</td>
				</tr>
				<tr>
					<td class="px-6 py-4">Esther Peixoto</td>
					<td class="px-6 py-4">estherpeixoto13@gmail.com</td>
					<td class="px-6 py-4 text-center">
						<a href='/dashboard/usuarios/1/alterar'>Alterar</a>
						<a href='/dashboard/usuarios/1/excluir'>Excluir</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</x-app-layout>
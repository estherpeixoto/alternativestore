<x-app-layout>
    <x-slot name='breadcrumbs'>
        {{ Breadcrumbs::render('products.index') }}
    </x-slot>

    <x-slot name='header'>
        {{ __('Produtos') }}
    </x-slot>

    <table id='table' class='w-full bg-white border divide-y divide-gray-300 whitespace-nowrap'>
        <thead class='bg-gray-50'>
            <tr class='text-sm leading-normal text-gray-600 uppercase bg-gray-200'>
				<th class='px-6 py-3 text-left'>Título</th>
                <th class='px-6 py-3 text-left'>Categoria</th>
                <th class='px-6 py-3 text-left'>Preço</th>
                <th class='px-6 py-3 text-center'>Opções</th>
            </tr>
        </thead>

        <tbody class='text-sm text-gray-600'>
            @foreach ($products as $product)
            <tr class='border-b border-gray-200 hover:bg-gray-100'>
				<td class='px-6 py-4 font-medium'>{{ $product->title }}</td>
                <td class='px-6 py-4 font-medium'>{{ $product->description }}</td>
                <td class='px-6 py-4'>{{ number_format($product->price, 2, ',', '.') }}</td>
                <td class='px-6 py-4 text-center'>
                    <x-admin.crud-options :id='$product->id' />
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>

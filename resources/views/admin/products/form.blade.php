<x-app-layout>
    <x-slot name='breadcrumbs'>
        {{ Breadcrumbs::render('products.form', $product->title ?? '') }}
    </x-slot>

    <x-slot name="header">
        {{ __('Produtos') }}
    </x-slot>

    <form method="POST" enctype="multipart/form-data" x-data="{ geral: true, imagens: false, tamanhos: false }" action="/dashboard/produtos{{ isset($product->id) ? "/$product->id" : '' }}">
        @csrf

        @if (isset($action))
        @if ($action == 'alterar')
        @method('PUT')
        @elseif ($action == 'excluir')
        @method('DELETE')
        @endif
        @endif

        <div class="flex items-center justify-center mb-5">
            <button type="button" @click="geral = true; imagens = false; tamanhos = false;" :class="{'border-b border-gray-700 text-gray-800': geral, 'hover:text-gray-800 text-gray-400 transition': !geral}" class="py-3 text-sm font-semibold uppercase rounded-none focus:outline-none">
                Geral
            </button>

            <button type="button" @click="geral = false; imagens = true; tamanhos = false;" :class="{'border-b border-gray-700 text-gray-800': imagens, 'hover:text-gray-800 text-gray-400 transition': !imagens}" class="py-3 ml-8 text-sm font-semibold uppercase rounded-none focus:outline-none">
                Imagens
            </button>

            <button type="button" @click="geral = false; imagens = false; tamanhos = true;" :class="{'border-b border-gray-700 text-gray-800': tamanhos, 'hover:text-gray-800 text-gray-400 transition': !tamanhos}" class="py-3 ml-8 text-sm font-semibold uppercase rounded-none focus:outline-none">
                Tamanhos
            </button>
        </div>

        <section id="geral" :class="{'block': geral, 'hidden': ! geral}">
            <div>
                <x-label for="title" :value="__('Título')" />

                <x-input id="title" type="text" name="title" value="{{ old('title') ?? ($product->title ?? '') }}" maxlength="100" required autofocus />
            </div>

            <div class="mt-5">
                <x-label for="description" :value="__('Descrição')" />

                <x-textarea id="description" name="description" required>
                    {{ old('description') ?? ($product->description ?? '') }}
                </x-textarea>
            </div>

            <div class="mt-5">
                <x-label for="category_id" :value="__('Categoria')" />

                <x-select id="category_id" name="category_id" required>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->description }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="mt-5">
                <x-label for="price" :value="__('Preço')" />

                <x-input id="price" type="text" name="price" value="{{ old('price') ?? (number_format($product->price, 2, '.', ',') ?? '') }}" required />
            </div>

            <div class="mt-5">
                <x-label for="visibility" :value="__('Visibilidade')" />

                <x-select id="visibility" name="visibility" required>
                    <option value="V" {{ old('visibility') ?? (isset($product) ? ($product->visibility == 'V' ? 'selected' : '') : '') }}>
                        Público
                    </option>

                    <option value="H" {{ old('visibility') ?? (isset($product) ? ($product->visibility == 'H' ? 'selected' : '') : '') }}>
                        Privado
                    </option>
                </x-select>
            </div>

            <div class="flex items-center justify-end mt-5">
                @if (isset($action))
                <x-button type="submit" color="outline-gray" class="mr-3">
                    Alterar
                </x-button>
                @endif

                <x-button type="button" color="blue" @click="geral = ! geral; imagens = ! imagens;">
                    Continuar
                </x-button>
            </div>
        </section>

        <section id="imagens" :class="{'block': imagens, 'hidden': ! imagens}">
            <div>
                <x-label for="images" :value="__('Upload de imagens')" />

                <input id="images" name="images[]" type="file" accept="image/*" multiple {{!isset($action) ? 'required' : ''}} class="hidden" />

                <div class='w-full'>
                    <div onclick="selectFiles()" class="py-16 mb-2 border-2 border-blue-300 border-dashed rounded-md cursor-pointer" style="background-color: #FBFDFF;">
                        <div id="img-message" class="flex flex-col items-center justify-center {{ isset($images) ? 'hidden' : '' }}">
                            <img class="m-0" src="{{ asset('images/icons/folder.svg') }}" />
                            <span class="mt-3 text-sm font-medium text-gray-400">Clique ou arraste a imagem</span>
                        </div>

                        <div id='img-preview' class="grid grid-cols-1 gap-2 px-16 sm:grid-cols-2 md:grid-cols-4">
                            @if (isset($images))
                            @foreach ($images as $k => $image)
                            <img src="{{asset("storage/products/$image->filename")}}" alt="img_{{$k}}" />
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <small class="text-xs font-medium text-gray-400">Formatos JPG ou PNG</small>
                </div>
            </div>

            <div class="flex items-center justify-end mt-5">
                @if (isset($action))
                <x-button type="submit" color="outline-gray" class="mr-3">Alterar imagens</x-button>
                @endif

                <x-button type="button" color="blue" @click="imagens = ! imagens; tamanhos = ! tamanhos;">Continuar</x-button>
            </div>
        </section>

        <section id="tamanhos" :class="{'block': tamanhos, 'hidden': ! tamanhos}">
            <div class="w-full overflow-x-auto position-relative">
                <x-label for="title" :value="__('Tabela de Tamanhos')" />

                <table class="w-full mb-2 bg-white border divide-y divide-gray-300 whitespace-nowrap">
                    <thead class='bg-gray-50'>
                        <tr class='text-sm leading-normal text-gray-600 uppercase bg-gray-200'>
                            <th class='px-6 py-3 text-left'>#</th>
                            @foreach ($sizes as $size)
                            <th class='px-6 py-3'>{{ $size->description }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class='text-sm text-gray-600'>
                        <tr class='border-b border-gray-200'>
                            <th class='px-6 py-3 text-left'>Busto</th>

                            @foreach ($sizes as $key => $size)
                            <td class="text-center">
                                <input class="py-2 text-center focus:outline-none" name="sizes[{{ $size->id }}][chest][]" value='{{ $productSizes[$key]->chest ?? '0,0' }}' />
                            </td>
                            @endforeach
                        </tr>

                        <tr class='border-b border-gray-200'>
                            <th class='px-6 py-3 text-left'>Ombros</th>

                            @foreach ($sizes as $key => $size)
                            <td class="text-center">
                                <input class="py-2 text-center focus:outline-none" name="sizes[{{ $size->id }}][shoulder][]" value='{{ $productSizes[$key]->shoulder ?? '0,0' }}' />
                            </td>
                            @endforeach
                        </tr>

                        <tr class='border-b border-gray-200'>
                            <th class='px-6 py-3 text-left'>Manga</th>

                            @foreach ($sizes as $key => $size)
                            <td class="text-center">
                                <input class="py-2 text-center focus:outline-none" name="sizes[{{ $size->id }}][sleeve][]" value='{{ $productSizes[$key]->sleeve ?? '0,0' }}' />
                            </td>
                            @endforeach
                        </tr>

                        <tr class='border-b border-gray-200'>
                            <th class='px-6 py-3 text-left'>Comprimento</th>

                            @foreach ($sizes as $key => $size)
                            <td class="text-center">
                                <input class="py-2 text-center focus:outline-none" name="sizes[{{ $size->id }}][length][]" value='{{ $productSizes[$key]->length ?? '0,0' }}' />
                            </td>
                            @endforeach
                        </tr>

                        <tr class='border-b border-gray-200'>
                            <th class='px-6 py-3 text-left'>Cintura</th>

                            @foreach ($sizes as $key => $size)
                            <td class="text-center">
                                <input class="py-2 text-center focus:outline-none" name="sizes[{{ $size->id }}][waist][]" value='{{ $productSizes[$key]->waist ?? '0,0' }}' />
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

                <small class="text-xs font-medium text-gray-400">Unidade: centímetros (cm)</small>
            </div>

            <x-admin.submit action="{{ $action ?? 'cadastrar' }}" />
        </section>
    </form>
</x-app-layout>

<script>
    function selectFiles() {
        document.getElementById('images').click()
    }

    let price = document.getElementById('price');

    Inputmask({
        mask: '999.999,99'
        , numericInput: true
    }).mask(price);

    const imgPreview = document.getElementById('img-preview')
    let inputFile = document.getElementById('images')

    inputFile.addEventListener('change', (event) => {
        let images = ''
        const imgMessage = document.getElementById('img-message')
        imgMessage.setAttribute('class', 'hidden')

        Array.from(inputFile.files).forEach((element) => {
            let fileReader = new FileReader()

            fileReader.readAsDataURL(element)

            fileReader.addEventListener('load', function() {
                images += `<img class='mb-6' src="${this.result}" />`
                imgPreview.innerHTML = images
            })
        })
    })

</script>

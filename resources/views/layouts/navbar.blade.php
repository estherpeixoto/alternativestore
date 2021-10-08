<header x-data="{ isSidebarOpen: false, isBagOpen: false, isSearchOpen: false, isDropdownOpen: false }">
    {{-- Navbar --}}
    <nav class="flex justify-between flex-shrink-0 h-16 px-8">
        {{-- Sidebar button and Logo --}}
        <div class="flex items-center gap-4 text-gray-900">
            <button
                @click="isDropdownOpen = false; isSidebarOpen = true; isBagOpen = false; isSearchOpen = false;"
                class="inline-flex items-center justify-center transition duration-150 ease-in-out sm:hidden focus:outline-none"
            >
                <svg
                    class="w-6 h-6"
                    stroke="currentColor"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        :class="{hidden: isSidebarOpen, 'inline-flex': !isSidebarOpen}"
                        class="inline-flex"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>
            </button>

            <a href="/">
                <x-application-logo class="block w-auto h-3.5 fill-current" />
            </a>
        </div>

        <div class="flex items-center gap-2.5 text-gray-900">
            {{-- Categories list (desktop) --}}
            <div class="flex items-center">
                <div class="relative hidden sm:block">
                    <div
                        x-on:mouseover="isDropdownOpen = true; isSidebarOpen = false; isBagOpen = false; isSearchOpen = false;">
                        <a
                            href="/produtos"
                            class="flex items-center text-xs font-medium tracking-wide uppercase transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300"
                        >
                            <div>Produtos</div>

                            <div class="ml-1">
                                <svg
                                    class="w-4 h-4 fill-current"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                        </a>
                    </div>

                    <div
                        x-show="isDropdownOpen"
                        x-on:mouseover="isDropdownOpen = true; isSidebarOpen = false; isBagOpen = false; isSearchOpen = false;"
                        x-on:mouseout="isDropdownOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 z-50 w-48 mt-2 origin-top-right"
                        style="display: none;"
                    >
                        <div class="py-1 bg-white ring-1 ring-black ring-opacity-5">
                            <ul>
                                <li class="px-3 py-1.5 text-xs font-medium tracking-wide uppercase hover:bg-gray-50">
                                    <a
                                        href="/produtos"
                                        class="block"
                                    >
                                        Todos
                                    </a>
                                </li>

                                @foreach ($categories as $category)
                                    <li
                                        class="px-3 py-1.5 text-xs font-medium tracking-wide uppercase hover:bg-gray-50">
                                        <a
                                            href="/produtos/{{ strtolower($category->description) }}"
                                            class="block"
                                        >
                                            {{ $category->description }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Search Bar (trigger) --}}
            <span
                class="cursor-pointer"
                @click="isDropdownOpen = false; isSidebarOpen = false; isBagOpen = false; isSearchOpen = true;"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    />
                </svg>
            </span>

            {{-- Bag (trigger) --}}
            {{-- <div
                class="cursor-pointer"
                class="relative"
            >
                <div @click="isDropdownOpen = false; isSidebarOpen = false; isBagOpen = true; isSearchOpen = false;">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
                        />
                    </svg>
                </div>
            </div> --}}
			<a href='{{ route('sacola') }}'>
				<svg
					xmlns="http://www.w3.org/2000/svg"
					class="w-6 h-6"
					fill="none"
					viewBox="0 0 24 24"
					stroke="currentColor"
				>
					<path
						stroke-linecap="round"
						stroke-linejoin="round"
						stroke-width="2"
						d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
					/>
				</svg>
			</a>
        </div>
    </nav>

    {{-- Categories list (mobile) --}}
    <aside
        :class="{'translate-x-0': isSidebarOpen, '-translate-x-full': !isSidebarOpen}"
        class="fixed top-0 left-0 z-30 w-full h-full overflow-auto transition-all duration-300 ease-in-out transform bg-white sm:hidden"
    >
        <div class="flex h-16 gap-4 px-8 text-gray-900 border-b">
            <button @click="isSidebarOpen = false">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

            <a
                class="flex items-center flex-shrink-0"
                href="{{ route('home') }}"
            >
                <x-application-logo class="block w-auto h-3.5 fill-current" />
            </a>
        </div>

        <ul class="px-8">
            @foreach ($categories as $category)
                <li class="pt-6 font-medium tracking-wide uppercase">
                    <a href="produtos/{{ strtolower($category->description) }}">
                        {{ $category->description }}
                    </a>
                </li>
            @endforeach
        </ul>
    </aside>

    {{-- Search Bar --}}
    <div
        x-show="isSearchOpen"
        class="fixed top-0 left-0 z-30 w-full bg-white h-42"
    >
        <div class="flex justify-center px-8 py-4">
            <div class="relative w-full">
                <label for="search-bar">O que você procura?</label>

                <span
                    class="absolute right-0 pr-4 cursor-pointer"
                    @click="isSearchOpen = false;"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </span>

                <form
                    action="/search"
                    class="relative mt-3"
                >
                    <input
                        id="search-bar"
                        name="q"
                        placeholder="Procurar..."
                        aria-placeholder="Procurar..."
                        class="w-full py-1 pl-4 text-base leading-8 text-gray-500 bg-white border border-gray-300 rounded outline-none pr-14 focus:placeholder-gray-300"
                        maxlength="100"
                    />

                    <button
                        type="submit"
                        class="absolute top-0 right-0 pt-2 pr-4"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-gray-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Bag --}}
    {{-- <div
        x-show="isBagOpen"
        x-on:mouseout="isBagOpen = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 translate-y-2.5"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 z-50 w-48 mt-2 origin-top-right"
        style="display: none;"
    >
        <div class="ring-1 ring-black ring-opacity-5">
            sacola
        </div>
    </div> --}}
</header>

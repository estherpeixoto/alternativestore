<!DOCTYPE html>
<html lang='{{ str_replace('_', '-', app()->getLocale()) }}'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='csrf-token' content='{{ csrf_token() }}'>

    <title>{{ config('app.name', 'Alternative Store') }}</title>

    <!-- Styles -->
    <link rel='stylesheet' href='{{ asset('css/app.css') }}'>

    <!-- Scripts -->
    <script src='{{ asset('js/app.js') }}' defer></script>
</head>

<body x-data="{ sidebarOpen: false }" class='h-screen' :class="{'overflow-hidden': sidebarOpen}">
    <div class="flex flex-col h-full font-sans antialiased text-gray-900">
        @include('layouts.navbar')

		{{ $slot }}

        @include('layouts.footer')
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Alternative Store | Painel Administrativo</title>

	<!-- Styles -->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
	<div class="min-h-screen bg-white">
		@include('admin.layouts.navigation')

		<!-- Page Content -->
		<main class='sm:ml-60 px-4'>
			<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
				<h2 class="font-semibold text-xl text-gray-800 leading-tight">
					{{ $header }}
				</h2>
			</div>

			<div class="py-12">
				<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
					<div class="overflow-hidden">
						{{ $slot }}
					</div>
				</div>
			</div>
		</main>
	</div>
</body>

</html>
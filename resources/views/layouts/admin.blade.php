<!DOCTYPE html>
<html lang='{{ str_replace('_', '-', app()->getLocale()) }}'>

<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta name='csrf-token' content='{{ csrf_token() }}'>

	<title>Alternative Store | Painel Administrativo</title>

	<!-- Styles -->
	<link rel='stylesheet' href='{{ asset('css/app.css') }}'>

	<!-- Scripts -->
	<script src='{{ asset('js/app.js') }}' defer></script>
</head>

<body class='font-sans antialiased'>
	<div class='min-h-screen bg-white'>
		@include('admin.layouts.navigation')

		<!-- Page Content -->
		<main class='px-4 sm:ml-60'>

			@if (isset($breadcrumbs) || isset($header))
				<div class='mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8'>
					@if (isset($breadcrumbs))
						{{ $breadcrumbs }}
					@endif

					@if (isset($header))
						<h2 class='text-xl font-semibold leading-tight text-gray-800'>
							{{ $header }}
						</h2>

						<hr class='my-6'>
					@endif
				</div>
			@endif

			<div class='mb-12'>
				<div class='mx-auto max-w-7xl sm:px-6 lg:px-8'>
					<div>
						<x-alert />

						{{ $slot }}
					</div>
				</div>
			</div>
		</main>
	</div>

	<link href="{{ asset('third-party/simple-datatables/style.css') }}" rel="stylesheet" type="text/css">
	<script src="{{ asset('third-party/simple-datatables/index.js') }}"></script>
	<script src="{{ asset('third-party/simple-datatables/config.js') }}"></script>

	<script src="https://unpkg.com/imask"></script>
</body>

</html>
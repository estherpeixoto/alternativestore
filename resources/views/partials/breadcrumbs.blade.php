@unless ($breadcrumbs->isEmpty())
<ol class='flex w-full py-3 text-gray-400 list-reset'>
	@foreach ($breadcrumbs as $breadcrumb)

		@if (!is_null($breadcrumb->url) && !$loop->last)
			<li class='transition hover:text-gray-700'>
				<a href='{{ $breadcrumb->url }}'>{{ $breadcrumb->title }}</a>
			</li>
		@else
			<li class='text-gray-700'>{{ $breadcrumb->title }}</li>
		@endif

		@if (!$loop->last)
			<span class='mx-2'>/</span>
		@endif

	@endforeach
</ol>
@endunless

<nav class="w-full z-10 bg-transparent md:flex-row md:flex-no-wrap md:justify-start flex items-center">
	<div class="w-full mx-auto items-center flex justify-between md:flex-no-wrap flex-wrap md:px-8 px-4">
		<div class="text-lg uppercase inline-block font-semibold text-pink-500 {{ isset($breadcrumb) ? '' : 'pt-4' }}">
			{{ $title }}
		</div>
	</div>
</nav>
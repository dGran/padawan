<div class="bg-gray-100 text-gray-700" style="box-shadow: inset 0 1px 0 #e1e4e8; box-shadow: inset 0 1px 0 #e1e4e8;">
	<div class="custom-container relative">
		<h4 class="pt-3">
			<span class="text-xl text-blue-600 font-semibold">
				{{ $tournament->name }}
			</span>
			<span class="text-sm text-blue-600 ml-3">
				{{ $tournament->game->name }}
			</span>
			<span class="text-sm text-blue-600 ml-3">
				{{ $tournament->game->platform->name }}
			</span>
		</h4>
		<div class="absolute" style="top:0; right: 2.5em">
			<div class="animated infinite flash slow mt-3 text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-teal-600 bg-teal-200 uppercase last:mr-0 mr-1">
			  Inscripciones abiertas
			</div>
			<div>
				<img src="{{ $tournament->game->img() }}" alt="" class="h-12 w-12 rounded-full shadow-lg inline-block">
				<img src="{{ $tournament->game->platform->img() }}" alt="" class="h-12 w-12 rounded-full shadow-lg inline-block">
			</div>
		</div>
		<nav class="py-3">
			<ul>
				<li class="inline-block mr-5">
<div class="group inline-block">
  <button
    class="outline-none focus:outline-none border px-3 py-1 bg-white rounded-sm flex items-center min-w-32"
  >
    <span class="pr-1 font-semibold flex-1">Competiciones</span>
    <span>
      <svg
        class="fill-current h-4 w-4 transform group-hover:-rotate-180
        transition duration-150 ease-in-out"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
      >
        <path
          d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
        />
      </svg>
    </span>
  </button>
  <ul
    class="bg-white border rounded-sm transform scale-0 group-hover:scale-100 absolute
  transition duration-150 ease-in-out origin-top min-w-32"
  >
    <li class="rounded-sm px-3 py-1 hover:bg-gray-100">Programming</li>
    <li class="rounded-sm px-3 py-1 hover:bg-gray-100">DevOps</li>
    <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
      <button
        class="w-full text-left flex items-center outline-none focus:outline-none"
      >
        <span class="pr-1 flex-1">Langauges</span>
        <span class="mr-auto">
          <svg
            class="fill-current h-4 w-4
            transition duration-150 ease-in-out"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
          >
            <path
              d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
            />
          </svg>
        </span>
      </button>
      <ul
        class="bg-white border rounded-sm absolute top-0 right-0
  transition duration-150 ease-in-out origin-top-left
  min-w-32
  "
      >
        <li class="px-3 py-1 hover:bg-gray-100">Javascript</li>
        <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
          <button
            class="w-full text-left flex items-center outline-none focus:outline-none"
          >
            <span class="pr-1 flex-1">Python</span>
            <span class="mr-auto">
              <svg
                class="fill-current h-4 w-4
                transition duration-150 ease-in-out"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
              >
                <path
                  d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                />
              </svg>
            </span>
          </button>
          <ul
            class="bg-white border rounded-sm absolute top-0 right-0
      transition duration-150 ease-in-out origin-top-left
      min-w-32
      "
          >
            <li class="px-3 py-1 hover:bg-gray-100">2.7</li>
            <li class="px-3 py-1 hover:bg-gray-100">3+</li>
          </ul>
        </li>
        <li class="px-3 py-1 hover:bg-gray-100">Go</li>
        <li class="px-3 py-1 hover:bg-gray-100">Rust</li>
      </ul>
    </li>
    <li class="rounded-sm px-3 py-1 hover:bg-gray-100">Testing</li>
  </ul>
</div>

<style>
  /* since nested groupes are not supported we have to use
     regular css for the nested dropdowns
  */
  li>ul                 { transform: translatex(100%) scale(0) }
  li:hover>ul           { transform: translatex(101%) scale(1) }
  li > button svg       { transform: rotate(-90deg) }
  li:hover > button svg { transform: rotate(-270deg) }

  /* Below styles fake what can be achieved with the tailwind config
     you need to add the group-hover variant to scale and define your custom
     min width style.
  	 See https://codesandbox.io/s/tailwindcss-multilevel-dropdown-y91j7?file=/index.html
  	 for implementation with config file
  */
  .group:hover .group-hover\:scale-100 { transform: scale(1) }
  .group:hover .group-hover\:-rotate-180 { transform: rotate(180deg) }
  .scale-0 { transform: scale(0) }
  .min-w-32 { min-width: 8rem }
</style>
				</li>
				<li class="inline-block mr-5">
					Competiciones
				</li>
				<li class="inline-block mr-5">
					Participantes
				</li>
				<li class="inline-block mr-5">
					...
				</li>
			</ul>
		</nav>
	</div>
</div>

<div class="text-gray-700" style="box-shadow: inset 0 -1px 0 #e1e4e8; box-shadow: inset 0 1px 0 #e1e4e8;">
	<div class="custom-container">
		<div class="flash-messages py-2">
			{{-- Hola que ase --}}
		</div>
	</div>
</div>
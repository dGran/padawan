<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
    	<h3 class="text-base font-bold mt-4 mb-2">
    		Por favor, selecciona el torneo...
    	</h3>
{{--         <div class="relative w-full xl:w-1/2">

            <select name="tournament" id="tournament" class="appearance-none h-full rounded border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                @foreach ($tournaments as $tournament)
                    <option value="{{ $tournament->slug }}">
                        {{ $tournament->name }} ({{ $tournament->game->name }} - {{ $tournament->game->platform->name }})
                    </option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>


        </div> --}}

		<div x-data="data()">
		    <input type="hidden" :value="selected.value">
		    <input type="text" x-model="search" placeholder="Click para buscar..." @click="optionsVisible = !optionsVisible">
		    <div x-show="optionsVisible">
		        <template x-for="option in filteredOptions()">
		            <a @click.prevent="selected = option; optionsVisible = false" x-text="option.name" class="cursor-pointer hover:text-blue-500" style="display: block;"></a>
		        </template>
		    </div>
		    <p>Current search: <span x-text="search"></span></p>
		    <p>Selected option: <span x-text="selected.name"></span></p>
		</div>
    </div>
</div>

<script>
function data() {
    return {
        optionsVisible: false,
        search: "",
        selected: {
            name: "",
            value: ""
        },
        options: [
            {
                name: "Abattoir Worker",
                value: "abattoir-worker"
            },
            {
                name: "Abbot",
                value: "abbot"
            }
        ],
        filteredOptions() {
            return this.options.filter((option) => {
                return option.value.includes(this.search.toLowerCase());
            });
        }
    };
}

</script>
<div class="inline-block">
	<label for="group_selector">Grupo</label>
	<div class="inline-block relative w-64">
	    <select name="group_selector" id="group_selector">
	        @foreach ($phase->groups as $pgroup)
	            <option {{ $pgroup->id == $group->id ? 'selected' : '' }} value="{{ route($route_name, [$tournament, $season, $competition, $phase, $pgroup]) }}">
	                {{ $pgroup->name }}
	            </option>
	        @endforeach
	    </select>
	    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
	        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
	    </div>
	</div>
</div>
<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">

		<div class="image">
        	<img src="{{ $position->img() }}">
		</div>
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $position->name }}
			</p>
	    	<div class="pt-3">
				<a href="{{ route('admin.positions.edit', $position->id) }}" class="edit">
		  			Editar
				</a>
				<a href="{{ route('admin.positions') }}" class="back">
		  			Volver
				</a>
			</div>
		</div>

{{-- 		<dl>
			<div>
				<dt>Fecha registro</dt>
				<dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia sed hic fuga natus vel, aliquid, veniam autem numquam a est corporis nulla quis ex, adipisci impedit iusto voluptatum reiciendis quasi.</dd>
			</div>
	    </dl> --}}

	</div>
</div>
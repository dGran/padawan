@if ($notifications->count() > 0)
	@foreach ($notifications as $notification)
		<article class="px-3 {{ $loop->first ? 'border-t-0' : 'border-t' }} border-border-color dark:border-dt-border-color | hover:bg-gray-50 dark:hover:bg-dt-border-color
		                     {{ $loop->first ? 'rounded-t-md' : '' }}
                             {{ $loop->last ? 'rounded-b-md' : '' }}">
			<div class="flex items-center justify-between space-x-3 py-2.5 | text-title-color dark:text-dt-title-color">
				<div class="w-full flex flex-col">
                    <span class="sm:hidden | text-xxxs md:text-xxs whitespace-nowrap | pr-3">
                        {{ $notification->created_at->diffForHumans(['options' => \Carbon\Carbon::ONE_DAY_WORDS]) }}
                    </span>
                    <p class="{{ $notification->read ? 'font-light opacity-70' : 'font-semibold' }}">
                        <span class="{{ $notification->read ? 'hidden' : '' }}">
                            <i class="fas fa-caret-right"></i>
                        </span>
                        {{ $notification->title }}
                    </p>
				</div>
                <span class="hidden sm:flex | text-xxxs md:text-xxs whitespace-nowrap pr-6">
                    {{ $notification->created_at->diffForHumans(['options' => \Carbon\Carbon::ONE_DAY_WORDS]) }}
                </span>
                <div class="flex items-center justify-end space-x-1.5">
                    <x-link href="{{ route('notifications.view', $notification->slug) }}" class="group" title="Ver">
						<span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-edblue-500 dark:group-hover:border-edblue-400 | group-focus:border-edblue-500 dark:group-focus:border-edblue-400">
							<i class="fas fa-eye"></i>
						</span>
                    </x-link>
                    <form method="GET" action="{{ route('notifications.toggleRead', $notification) }}">
                        @csrf
                        <x-button-link type="submit" class="group" title="{{ $notification->read ? 'Marcar como no leído' : 'Marcar como leído' }}">
                            <span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-edblue-500 dark:group-hover:border-edblue-400 | group-focus:border-edblue-500 dark:group-focus:border-edblue-400">
                                <i class="{{ $notification->read ? 'far' : 'fas' }} fa-file-alt"></i>
                            </span>
                        </x-button-link>
                    </form>
                    <div x-cloak x-data="{ open: false }">
                        <x-button-link color="rose" class="group" @click="open = true" title="Eliminar">
							<span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-rose-500 dark:group-hover:border-rose-400 | group-focus:border-rose-500 dark:group-focus:border-rose-400">
								<i class="fas fa-trash"></i>
							</span>
                        </x-button-link>
                        <x-modal>
                            @include('account.notifications.modals.confirmation-delete')
                        </x-modal>
                    </div>
                </div>
			</div>
		</article>
	@endforeach
@else
	<div class="px-3 py-4 | text-center">
		No se han encontrado resultados
		{{ $search || $unread ? 'con el filtro aplicado' : '' }}
	</div>
@endif

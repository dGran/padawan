@if ($requests->count() > 0)
    @foreach ($requests as $request)
        <div class="flex flex-col py-1.5">
            <div
                class="rounded-md | bg-white dark:bg-dt-dark | border border-border-color dark:border-dt-border-color">
                <div class="w-full | p-3 | flex flex-col items-center">
                    <img src="{{ $request->eteam->getLogo() }}" alt=""
                         class="w-12 h-12 object-cover rounded-full | border border-border-color dark:border-dt-border-color">
                    <x-link href="{{ route('eteams.eteam', $request->eteam->slug) }}">
                        {{ $request->eteam->name }}
                    </x-link>
                </div>
                <div
                    class="w-full | p-3 | flex items-center justify-center space-x-3 | border-t border-border-color dark:border-dt-border-color">
                    <x-button color="edgray" class="w-40">
                        <span class="text-xs">Retirar solicitud</span>
                    </x-button>
                </div>
            </div>
        </div>
    @endforeach
@else
    No tienes solicitudes enviadas pendientes
@endif

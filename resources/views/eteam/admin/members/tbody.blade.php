@foreach ($members as $member)
    <tr class="border-b border-border-color dark:border-edgray-700 hover:bg-gray-100 dark:hover:bg-dt-light-accent"
        wire:loading.class="opacity-75">
        <td class="text-xs font-light px-4 py-2.5 whitespace-nowrap">
            {{ $member->getCreatedAtDate() }} - {{ $member->getCreatedAtTime() }}
        </td>
        <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
            <a href="#"
               class="text-edblue-500 dark:text-edblue-400 | hover:text-edblue-600 dark:hover:text-edblue-300 | focus:outline-none focus:text-edblue-600 dark:focus:text-edblue-300 | transition ease-in-out duration-150 | cursor-pointer"
               onclick='Livewire.emit("openModal", "modals.user-modal", @json(['user' => $member->user]))'>
                {{ $member->user->name }}
            </a>
        </td>
    </tr>
@endforeach

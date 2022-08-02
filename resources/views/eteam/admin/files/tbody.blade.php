@foreach ($files as $file)
    <tr class="border-b border-border-color dark:border-edgray-700 hover:bg-gray-100 dark:hover:bg-dt-light-accent"
        wire:loading.class="opacity-75">
        <td class="text-xs font-light px-4 py-2.5 whitespace-nowrap">
            {{ $file->getCreatedAtDate() }} - {{ $file->getCreatedAtTime() }}
        </td>
    </tr>
@endforeach

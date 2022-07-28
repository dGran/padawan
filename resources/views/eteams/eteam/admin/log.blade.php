<div class="p-4 md:p-6 lg:p-8">
    <div class="overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
        <div class="py-2 inline-block min-w-full">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="border-b border-border-color dark:border-edgray-700">
                    <tr>
                        <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                            Fecha
                        </th>
                        <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                            Message
                        </th>
                        <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                            Acciones
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($eteam->logs as $log)
                        <tr class="border-b border-border-color dark:border-edgray-700">
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                {{ $log->created_at->diffForHumans() }}
                            </td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                {{ $log->message }}
                            </td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                ...
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

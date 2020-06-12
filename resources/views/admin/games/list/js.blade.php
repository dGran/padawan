<script>
    var routeAdd = "{{ route('admin.games.add') }}";
    var routeEdit = "{{ route('admin.games.edit', ':ID') }}";
    var routeDestroy = "{{ route('admin.games.destroy', ':IDS') }}";
    var routeView = "{{ route('admin.games.view', ':ID') }}";
    var routeDuplicate = "{{ route('admin.games.duplicate', ':IDS') }}";
    var routeExport = "{{ route('admin.games.export', [':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.games.export.global', [':FORMAT', ':FILENAME', $order, $filterName]) }}";
</script>
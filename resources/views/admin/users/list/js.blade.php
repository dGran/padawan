<script>
    var routeAdd = "{{ route('admin.users.add') }}";
    var routeEdit = "{{ route('admin.users.edit', ':ID') }}";
    var routeDestroy = "{{ route('admin.users.destroy', ':IDS') }}";
    var routeDuplicate = "{{ route('admin.users.duplicate', ':IDS') }}";
    var routeExport = "{{ route('admin.users.export', [':FORMAT', ':IDS', ':FILENAME', $sortField, $sortDirection]) }}";
    var routeExportGlobal = "{{ route('admin.users.export.global', [':FORMAT', ':FILENAME', $sortField, $sortDirection, $filterName]) }}";
</script>
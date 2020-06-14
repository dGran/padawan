<script>
    var routeAdd = "{{ route('admin.platforms.add') }}";
    var routeEdit = "{{ route('admin.platforms.edit', ':ID') }}";
    var routeDestroy = "{{ route('admin.platforms.destroy', ':IDS') }}";
    var routeView = "{{ route('admin.platforms.view', ':ID') }}";
    var routeDuplicate = "{{ route('admin.platforms.duplicate', ':IDS') }}";
    var routeExport = "{{ route('admin.platforms.export', [':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.platforms.export.global', [':FORMAT', ':FILENAME', $order, $filterName]) }}";

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });
</script>
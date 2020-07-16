<script>
    var routeAdd = "{{ route('admin.reserves.add', [$tournament, $season]) }}";
    var routeEdit = "{{ route('admin.reserves.edit', [$tournament, $season, ':ID']) }}";
    var routeDestroy = "{{ route('admin.reserves.destroy', [$tournament, $season, ':IDS']) }}";
    var routeView = "{{ route('admin.reserves.view', [$tournament, $season, ':ID']) }}";
    var routeExport = "{{ route('admin.reserves.export', [$tournament, $season, ':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.reserves.export.global', [$tournament, $season, ':FORMAT', ':FILENAME', $order]) }}";

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });
</script>
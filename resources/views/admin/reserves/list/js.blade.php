<script>
    var routeAdd = "{{ route('admin.reserves.add', [$tournament, $season->slug]) }}";
    var routeEdit = "{{ route('admin.reserves.edit', [$tournament, $season->slug, ':ID']) }}";
    var routeDestroy = "{{ route('admin.reserves.destroy', [$tournament, $season->slug, ':IDS']) }}";
    var routeView = "{{ route('admin.reserves.view', [$tournament, $season->slug, ':ID']) }}";
    var routeExport = "{{ route('admin.reserves.export', [$tournament, $season->slug, ':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.reserves.export.global', [$tournament, $season->slug, ':FORMAT', ':FILENAME', $order]) }}";

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });
</script>
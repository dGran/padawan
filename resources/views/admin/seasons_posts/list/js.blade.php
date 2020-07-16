<script>
    var routeAdd = "{{ route('admin.seasons_posts.add', [$tournament, $season]) }}";
    var routeEdit = "{{ route('admin.seasons_posts.edit', [$tournament, $season, ':ID']) }}";
    var routeDestroy = "{{ route('admin.seasons_posts.destroy', [$tournament, $season, ':IDS']) }}";
    var routeView = "{{ route('admin.seasons_posts.view', [$tournament, $season, ':ID']) }}";
    var routeDuplicate = "{{ route('admin.seasons_posts.duplicate', [$tournament, $season, ':IDS']) }}";
    var routeExport = "{{ route('admin.seasons_posts.export', [$tournament, $season, ':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.seasons_posts.export.global', [$tournament, $season, ':FORMAT', ':FILENAME', $order]) }}";

    function cancelFilterType() {
        $("#filterType").val('');
        applyFilters();
    }

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });
</script>
<script>
    var routeAdd = "{{ route('admin.seasons_posts.add', [$tournament, $season->slug]) }}";
    var routeEdit = "{{ route('admin.seasons_posts.edit', [$tournament, $season->slug, ':ID']) }}";
    var routeDestroy = "{{ route('admin.seasons_posts.destroy', [$tournament, $season->slug, ':IDS']) }}";
    var routeView = "{{ route('admin.seasons_posts.view', [$tournament, $season->slug, ':ID']) }}";
    var routeDuplicate = "{{ route('admin.seasons_posts.duplicate', [$tournament, $season->slug, ':IDS']) }}";
    var routeExport = "{{ route('admin.seasons_posts.export', [$tournament, $season->slug, ':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.seasons_posts.export.global', [$tournament, $season->slug, ':FORMAT', ':FILENAME', $order]) }}";

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });
</script>
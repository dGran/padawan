<script>
    var routeAdd = "{{ route('admin.teams.add') }}";
    var routeEdit = "{{ route('admin.teams.edit', ':ID') }}";
    var routeDestroy = "{{ route('admin.teams.destroy', ':IDS') }}";
    var routeView = "{{ route('admin.teams.view', ':ID') }}";
    var routeDuplicate = "{{ route('admin.teams.duplicate', ':IDS') }}";
    var routeExport = "{{ route('admin.teams.export', [':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.teams.export.global', [':FORMAT', ':FILENAME', $order]) }}";

    function cancelFilterGame() {
        $("#filterGame").val('0');
        applyFilters();
    }

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });
</script>
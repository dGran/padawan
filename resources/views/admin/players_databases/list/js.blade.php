<script>
    var routeAdd = "{{ route('admin.players_databases.add') }}";
    var routeEdit = "{{ route('admin.players_databases.edit', ':ID') }}";
    var routeDestroy = "{{ route('admin.players_databases.destroy', ':IDS') }}";
    var routeView = "{{ route('admin.players_databases.view', ':ID') }}";
    var routeDuplicate = "{{ route('admin.players_databases.duplicate', ':IDS') }}";
    var routeExport = "{{ route('admin.players_databases.export', [':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.players_databases.export.global', [':FORMAT', ':FILENAME', $order]) }}";

    function cancelFilterGame() {
        $("#filterGame").val('0');
        applyFilters();
    }

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });
</script>
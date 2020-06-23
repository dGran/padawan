<script>
    var routeAdd = "{{ route('admin.players.add', $filterPlayerDatabase) }}";
    var routeEdit = "{{ route('admin.players.edit', ':ID') }}";
    var routeDestroy = "{{ route('admin.players.destroy', ':IDS') }}";
    var routeView = "{{ route('admin.players.view', ':ID') }}";
    var routeDuplicate = "{{ route('admin.players.duplicate', ':IDS') }}";
    var routeExport = "{{ route('admin.players.export', [':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.players.export.global', [':FORMAT', ':FILENAME', $order]) }}";

    // function cancelFilterPlayerDatabase() {
    //     $("#filterPlayerDatabase").val('0');
    //     applyFilters();
    // }

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });
</script>
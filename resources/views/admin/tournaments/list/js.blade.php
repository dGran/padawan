<script>
    var routeAdd = "{{ route('admin.tournaments.add') }}";
    var routeEdit = "{{ route('admin.tournaments.edit', ':ID') }}";
    var routeDestroy = "{{ route('admin.tournaments.destroy', ':IDS') }}";
    var routeView = "{{ route('admin.tournaments.view', ':ID') }}";
    var routeDuplicate = "{{ route('admin.tournaments.duplicate', ':IDS') }}";
    var routeExport = "{{ route('admin.tournaments.export', [':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.tournaments.export.global', [':FORMAT', ':FILENAME', $order]) }}";

    function cancelFilterGame() {
        $("#filterGame").val('0');
        applyFilters();
    }

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });
</script>
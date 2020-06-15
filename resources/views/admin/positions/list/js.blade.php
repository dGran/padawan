<script>
    var routeAdd = "{{ route('admin.positions.add') }}";
    var routeEdit = "{{ route('admin.positions.edit', ':ID') }}";
    var routeDestroy = "{{ route('admin.positions.destroy', ':IDS') }}";
    var routeView = "{{ route('admin.positions.view', ':ID') }}";
    var routeDuplicate = "{{ route('admin.positions.duplicate', ':IDS') }}";
    var routeExport = "{{ route('admin.positions.export', [':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.positions.export.global', [':FORMAT', ':FILENAME', $order]) }}";

    function cancelFilterGame() {
        $("#filterGame").val('0');
        applyFilters();
    }

    function cancelFilterCategory() {
        $("#filterCategory").val('');
        applyFilters();
    }

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });
</script>
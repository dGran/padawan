<script>
    var routeAdd = "{{ route('admin.circuits.add') }}";
    var routeEdit = "{{ route('admin.circuits.edit', ':ID') }}";
    var routeDestroy = "{{ route('admin.circuits.destroy', ':IDS') }}";
    var routeView = "{{ route('admin.circuits.view', ':ID') }}";
    var routeDuplicate = "{{ route('admin.circuits.duplicate', ':IDS') }}";
    var routeExport = "{{ route('admin.circuits.export', [':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.circuits.export.global', [':FORMAT', ':FILENAME', $order]) }}";

    function cancelFilterGame() {
        $("#filterGame").val('0');
        applyFilters();
    }

    function cancelFilterCountry() {
        $("#filterCountry").val('0');
        applyFilters();
    }

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });
</script>
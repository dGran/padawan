<script>
    var routeAdd = "{{ route('admin.users.add') }}";
    var routeEdit = "{{ route('admin.users.edit', ':ID') }}";
    var routeDestroy = "{{ route('admin.users.destroy', ':IDS') }}";
    var routeView = "{{ route('admin.users.view', ':ID') }}";
    var routeDuplicate = "{{ route('admin.users.duplicate', ':IDS') }}";
    var routeExport = "{{ route('admin.users.export', [':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.users.export.global', [':FORMAT', ':FILENAME', $order]) }}";

    function cancelFilterOnlyAdmin() {
        $("#filterOnlyAdmin").prop("checked", false);
        applyFilters();
    }

    function cancelFilterOnlyVerified() {
        $("#filterOnlyVerified").prop("checked", false);
        applyFilters();
    }

    function cancelFilterOnlyNotVerified() {
        $("#filterOnlyVerified").prop("checked", false);
        applyFilters();
    }

    $("#filterOnlyVerified").on("click", function() {
        if ($(this).prop("checked")) {
            $("#filterOnlyNotVerified").prop("checked", false);
        }
    });

    $("#filterOnlyNotVerified").on("click", function() {
        if ($(this).prop("checked")) {
            $("#filterOnlyVerified").prop("checked", false);
        }
    });

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });
</script>
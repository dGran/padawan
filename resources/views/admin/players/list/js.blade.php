<script>
    loadPositions();

    var routeAdd = "{{ route('admin.players.add', $filterPlayerDatabase) }}";
    var routeEdit = "{{ route('admin.players.edit', ':ID') }}";
    var routeDestroy = "{{ route('admin.players.destroy', ':IDS') }}";
    var routeView = "{{ route('admin.players.view', ':ID') }}";
    var routeDuplicate = "{{ route('admin.players.duplicate', ':IDS') }}";
    var routeExport = "{{ route('admin.players.export', [':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.players.export.global', [':FORMAT', ':FILENAME', $order]) }}";

    var filterOverallRangeFrom = "{{ $filterOverallRangeFrom }}";
    var filterOverallRangeTo = "{{ $filterOverallRangeTo }}";
    var filterAgeRangeFrom = "{{ $filterAgeRangeFrom }}";
    var filterAgeRangeTo = "{{ $filterAgeRangeTo }}";
    var filterHeightRangeFrom = "{{ $filterHeightRangeFrom }}";
    var filterHeightRangeTo = "{{ $filterHeightRangeTo }}";

    function cancelFilterPlayerDatabase() {
        $("#filterPlayerDatabase").val('0');
        cancelFilterPosition();
    }

    function cancelFilterPosition() {
        $("#filterPosition").val('0');
        applyFilters();
    }

    function cancelFilterNation() {
        $("#filterNation").val('');
        applyFilters();
    }

    function cancelFilterTeam() {
        $("#filterTeam").val('');
        applyFilters();
    }

    function cancelFilterLeague() {
        $("#filterLeague").val('');
        applyFilters();
    }

    function cancelFilterGameID() {
        $("#filterGameID").val('');
        applyFilters();
    }

    function cancelFilterFoot() {
        $("#filterFoot").val('');
        applyFilters();
    }

    function cancelFilterOverallRange() {
        $("#filterOverallRange").val('');
        applyFilters();
    }

    function cancelFilterAgeRange() {
        $("#filterAgeRange").val('');
        applyFilters();
    }

    function cancelFilterHeightRange() {
        $("#filterHeightRange").val('');
        applyFilters();
    }

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });

    function loadPositions() {
        $('#loading').removeClass("hidden");
        var route = "{{ route('admin.players.load_positions', [':ID', 'list', $filterPosition]) }}";
        var id = $("#filterPlayerDatabase option:selected").val();
        var url = route.replace(':ID', id);
        if (id == 0) {
            $('#filterPosition').find('option').remove().end().append('<option value="0">Todas</option>');
            $('#filterPosition').addClass("disable");
        } else {
            $.ajax({
                url         : url,
                type        : 'GET',
                datatype    : 'html',
            }).done(function(data){
                $('#filterPosition').html(data);
                $('#filterPosition').removeClass("disable");
            });
        }
        $('#loading').addClass("hidden");
    }

    $("#filterOverallRange").ionRangeSlider({
        skin: "big",
        type: "double",
        grid: true,
        min: 50,
        max: 99,
        step: 1,
        from: filterOverallRangeFrom,
        to: filterOverallRangeTo,
        grid: true,
        grid_num: 10,
    });

    $("#filterAgeRange").ionRangeSlider({
        skin: "big",
        type: "double",
        grid: true,
        min: 15,
        max: 45,
        step: 1,
        from: filterAgeRangeFrom,
        to: filterAgeRangeTo,
        grid: true,
        grid_num: 6,
        postfix: " años"
    });

    $("#filterHeightRange").ionRangeSlider({
        skin: "big",
        type: "double",
        grid: true,
        min: 150,
        max: 210,
        step: 1,
        from: filterHeightRangeFrom,
        to: filterHeightRangeTo,
        grid: true,
        grid_num: 6,
        postfix: " cm"
    });
</script>
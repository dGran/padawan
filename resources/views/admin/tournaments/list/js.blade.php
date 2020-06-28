<script>
    var routeAdd = "{{ route('admin.tournaments.add') }}";
    var routeEdit = "{{ route('admin.tournaments.edit', ':ID') }}";
    var routeDestroy = "{{ route('admin.tournaments.destroy', ':IDS') }}";
    var routeView = "{{ route('admin.tournaments.view', ':ID') }}";
    var routeDuplicate = "{{ route('admin.tournaments.duplicate', ':IDS') }}";
    var routeExport = "{{ route('admin.tournaments.export', [':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.tournaments.export.global', [':FORMAT', ':FILENAME', $order]) }}";

    var routeSeasons = "{{ route('admin.seasons', ':SLUG') }}";

    function cancelFilterGame() {
        $("#filterGame").val('0');
        applyFilters();
    }

    function cancelFilterParticipantType() {
        $("#filterParticipantType").val('');
        applyFilters();
    }

    function cancelFilterMarket() {
        $("#filterMarket").val('');
        applyFilters();
    }

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });

    $(function() {
        checkRowSelectedCustom();
    });

    //Selected regs
    function checkRowSelectedCustom() {
        elements = $(".mark:checked").length;
        if (elements > 0) {
            hideGlobalOptions();
            hideFilters();
            showRowOptions();
            if (elements == 1) {
                $(".selected-regs-count").text($(".mark:checked").parents('tr').attr('data-name'));
                $("#edit").show();
                $("#seasons").show();
                $("#view").show();
                $("#destroy").removeClass('hint--top-right');
                $("#destroy").addClass('hint--top');
            } else {
                $(".selected-regs-count").text(elements + ' registros seleccionados');
                $("#edit").hide();
                $("#seasons").hide();
                $("#view").hide();
                $("#destroy").removeClass('hint--top');
                $("#destroy").addClass('hint--top-right');
            }
        } else {
            hideRowOptions();
        }
    }

    function showHideRowOptionsCustom(element) {
        if ($(element).is(':checked')) {
            $(element).parents('tr').addClass('selected');
        } else {
            $(element).parents('tr').removeClass('selected');
        }
        checkRowSelectedCustom();
    }

    function seasons() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routeSeasons;
        var url = route.replace(':SLUG', slug);
        window.location.href=url;
        admin.seasons
    }
</script>
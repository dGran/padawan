<script>
    var routeAdd = "{{ route('admin.competitions.add', [$tournament, $season]) }}";
    var routeEdit = "{{ route('admin.competitions.edit', [$tournament, $season, ':ID']) }}";
    var routeDestroy = "{{ route('admin.competitions.destroy', [$tournament, $season, ':IDS']) }}";
    var routeView = "{{ route('admin.competitions.view', [$tournament, $season, ':ID']) }}";
    var routeDuplicate = "{{ route('admin.competitions.duplicate', [$tournament, $season, ':IDS']) }}";
    var routeExport = "{{ route('admin.competitions.export', [$tournament, $season, ':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.competitions.export.global', [$tournament, $season, ':FORMAT', ':FILENAME', $order]) }}";

    var routePhases = "{{ route('admin.phases', [$tournament, $season, ':SLUG']) }}";
    var routeGenerate = "{{ route('admin.phases', [$tournament, $season, ':ID']) }}";

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
                $("#phases").show();
                $("#view").show();
                $("#destroy").removeClass('hint--top-right');
                $("#destroy").addClass('hint--top');
            } else {
                $(".selected-regs-count").text(elements + ' registros seleccionados');
                $("#edit").hide();
                $("#phases").hide();
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

    function showHideAllRowOptionsCustom() {
        if ($("#allMark").is(':checked')) {
            $(".mark").prop('checked', true);
            $(".mark").parents('tr').addClass('selected');
        } else {
            $(".mark").prop('checked', false);
            $(".mark").parents('tr').removeClass('selected');
        }
        showHideRowOptionsCustom();
    }

    function phases() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routePhases;
        var url = route.replace(':SLUG', slug);
        window.location.href=url;
    }
</script>
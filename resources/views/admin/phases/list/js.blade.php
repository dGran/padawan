<script>
    var routeAdd = "{{ route('admin.phases.add', [$tournament, $season, $competition]) }}";
    var routeEdit = "{{ route('admin.phases.edit', [$tournament, $season, $competition, ':ID']) }}";
    var routeDestroy = "{{ route('admin.phases.destroy', [$tournament, $season, $competition, ':IDS']) }}";
    var routeView = "{{ route('admin.phases.view', [$tournament, $season, $competition, ':ID']) }}";
    var routeDuplicate = "{{ route('admin.phases.duplicate', [$tournament, $season, $competition, ':IDS']) }}";
    var routeExport = "{{ route('admin.phases.export', [$tournament, $season, $competition, ':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.phases.export.global', [$tournament, $season, $competition, ':FORMAT', ':FILENAME', $order]) }}";

    var routeGroups = "{{ route('admin.phases', [$tournament, $season, $competition, ':SLUG']) }}";

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
                $("#groups").show();
                $("#view").show();
                $("#destroy").removeClass('hint--top-right');
                $("#destroy").addClass('hint--top');
            } else {
                $(".selected-regs-count").text(elements + ' registros seleccionados');
                $("#edit").hide();
                $("#groups").hide();
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

    function groups() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routeGroups;
        var url = route.replace(':SLUG', slug);
        window.location.href=url;
    }
</script>
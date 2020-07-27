<script>
    var routeAdd = "{{ route('admin.groups.add', [$tournament, $season, $competition, $phase]) }}";
    var routeEdit = "{{ route('admin.groups.edit', [$tournament, $season, $competition, $phase, ':ID']) }}";
    var routeDestroy = "{{ route('admin.groups.destroy', [$tournament, $season, $competition, $phase, ':IDS']) }}";
    var routeView = "{{ route('admin.groups.view', [$tournament, $season, $competition, $phase, ':ID']) }}";
    var routeDuplicate = "{{ route('admin.groups.duplicate', [$tournament, $season, $competition, $phase, ':IDS']) }}";
    var routeExport = "{{ route('admin.groups.export', [$tournament, $season, $competition, $phase, ':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.groups.export.global', [$tournament, $season, $competition, $phase, ':FORMAT', ':FILENAME', $order]) }}";
    var routeActivate = "{{ route('admin.groups.activate', [$tournament, $season, $competition, $phase, ':IDS']) }}";
    var routeDesactivate = "{{ route('admin.groups.desactivate', [$tournament, $season, $competition, $phase, ':IDS']) }}";

    var routeParticipants = "{{ route('admin.groups_participants', [$tournament, $season, $competition, $phase, ':SLUG']) }}";

    var $mode = "{{ $phase->mode }}";
    if ($mode == 'league') {
        var routeCompetition = "{{ route('admin.league.config', [$tournament, $season, $competition, $phase, ':SLUG']) }}";
    }
    if ($mode == 'playoff') {
        var routeCompetition = "{{ route('admin.playoff.config', [$tournament, $season, $competition, $phase, ':SLUG']) }}";
    }
    if ($mode == 'race') {
        var routeCompetition = "{{ route('admin.racing.config', [$tournament, $season, $competition, $phase, ':SLUG']) }}";
    }

    check_max_participants();
    function check_max_participants() {
        var full = "{{ $phase->fullParticipants() }}";
        if (full) {
            $(".add").addClass('disable');
        } else {
            $(".add").removeClass('disable');
        }
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
                $("#participants").show();
                $("#competition").show();
                $("#view").show();
                $("#destroy").removeClass('hint--top-right');
                $("#destroy").addClass('hint--top');
            } else {
                $(".selected-regs-count").text(elements + ' registros seleccionados');
                $("#edit").hide();
                $("#participants").hide();
                $("#competition").hide();
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

    function activate() {
        var route = routeActivate;
        var ids = [];
        $(".mark:checked").each(function() {
            ids.push($(this).val());
        });
        var url = route.replace(':IDS', ids);
        window.location.href=url;
    }

    function desactivate() {
        var route = routeDesactivate;
        var ids = [];
        $(".mark:checked").each(function() {
            ids.push($(this).val());
        });
        var url = route.replace(':IDS', ids);
        window.location.href=url;
    }

    function participants() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routeParticipants;
        var url = route.replace(':SLUG', slug);
        window.location.href=url;
    }

    function competition() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routeCompetition;
        var url = route.replace(':SLUG', slug);
        window.location.href=url;
    }
</script>
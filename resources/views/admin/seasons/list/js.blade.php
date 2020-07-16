<script>
    var routeAdd = "{{ route('admin.seasons.add', $tournament) }}";
    var routeEdit = "{{ route('admin.seasons.edit', [$tournament, ':ID']) }}";
    var routeDestroy = "{{ route('admin.seasons.destroy', [$tournament, ':IDS']) }}";
    var routeView = "{{ route('admin.seasons.view', [$tournament, ':ID']) }}";
    var routeDuplicate = "{{ route('admin.seasons.duplicate', [$tournament, ':IDS']) }}";
    var routeExport = "{{ route('admin.seasons.export', [$tournament, ':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.seasons.export.global', [$tournament, ':FORMAT', ':FILENAME', $order]) }}";

    var routeParticipants = "{{ route('admin.participants', [$tournament, ':SEASON_SLUG']) }}";
    var routeReserves = "{{ route('admin.reserves', [$tournament, ':SEASON_SLUG']) }}";
    var routeCompetitions = "{{ route('admin.competitions', [$tournament, ':SEASON_SLUG']) }}";
    var routePosts = "{{ route('admin.seasons_posts', [$tournament, ':SEASON_SLUG']) }}";
    var routeCash = "{{ route('admin.cash', [$tournament, ':SEASON_SLUG']) }}";
    var routePlayers = "{{ route('admin.season_players', [$tournament, ':SEASON_SLUG']) }}";
    var routeTransfers = "{{ route('admin.transfers', [$tournament, ':SEASON_SLUG']) }}";

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
                $("#reserves").show();
                $("#competitions").show();
                $("#posts").show();
                $("#cash").show();
                $("#players").show();
                $("#transfers").show();
                $("#view").show();
                $("#destroy").removeClass('hint--top-right');
                $("#destroy").addClass('hint--top');
            } else {
                $(".selected-regs-count").text(elements + ' registros seleccionados');
                $("#edit").hide();
                $("#participants").hide();
                $("#reserves").hide();
                $("#competitions").hide();
                $("#posts").hide();
                $("#cash").hide();
                $("#players").hide();
                $("#transfers").hide();
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

    function participants() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routeParticipants.replace(':SEASON_SLUG', slug);
        var url = route;
        window.location.href=url;
    }

    function reserves() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routeReserves.replace(':SEASON_SLUG', slug);
        var url = route;
        window.location.href=url;
    }

    function competitions() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routeCompetitions.replace(':SEASON_SLUG', slug);
        var url = route;
        window.location.href=url;
    }

    function posts() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routePosts.replace(':SEASON_SLUG', slug);
        var url = route;
        window.location.href=url;
    }

    function cash() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routeCash.replace(':SEASON_SLUG', slug);
        var url = route;
        window.location.href=url;
    }

    function players() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routePlayers.replace(':SEASON_SLUG', slug);
        var url = route;
        window.location.href=url;
    }

    function transfers() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routeTransfers.replace(':SEASON_SLUG', slug);
        var url = route;
        window.location.href=url;
    }

</script>
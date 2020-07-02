<script>
    var routeAdd = "{{ route('admin.seasons.add', $tournament) }}";
    var routeEdit = "{{ route('admin.seasons.edit', [$tournament, ':ID']) }}";
    var routeDestroy = "{{ route('admin.seasons.destroy', [$tournament, ':IDS']) }}";
    var routeView = "{{ route('admin.seasons.view', [$tournament, ':ID']) }}";
    var routeDuplicate = "{{ route('admin.seasons.duplicate', [$tournament, ':IDS']) }}";
    var routeExport = "{{ route('admin.seasons.export', [$tournament, ':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.seasons.export.global', [$tournament, ':FORMAT', ':FILENAME', $order]) }}";

    var routeParticipants = "{{ route('admin.participants', [':TOURNAMENT_SLUG', ':SEASON_SLUG']) }}";
    var routeCompetitions = "{{ route('admin.competitions', [':TOURNAMENT_SLUG', ':SEASON_SLUG']) }}";
    var routePosts = "{{ route('admin.posts', [':TOURNAMENT_SLUG', ':SEASON_SLUG']) }}";
    var routeCash = "{{ route('admin.cash', [':TOURNAMENT_SLUG', ':SEASON_SLUG']) }}";
    var routeTransfers = "{{ route('admin.transfers', [':TOURNAMENT_SLUG', ':SEASON_SLUG']) }}";

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
                $("#competitions").show();
                $("#posts").show();
                $("#cash").show();
                $("#transfers").show();
                $("#view").show();
                $("#destroy").removeClass('hint--top-right');
                $("#destroy").addClass('hint--top');
            } else {
                $(".selected-regs-count").text(elements + ' registros seleccionados');
                $("#edit").hide();
                $("#participants").hide();
                $("#competitions").hide();
                $("#posts").hide();
                $("#cash").hide();
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

    function participants() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var tournament_slug = $(element).parents('tr').attr('data-tournament-slug');
        var route = routeParticipants.replace(':TOURNAMENT_SLUG', tournament_slug).replace(':SEASON_SLUG', slug);
        var url = route;
        window.location.href=url;
    }

    function competitions() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var tournament_slug = $(element).parents('tr').attr('data-tournament-slug');
        var route = routeCompetitions.replace(':TOURNAMENT_SLUG', tournament_slug).replace(':SEASON_SLUG', slug);
        var url = route;
        window.location.href=url;
    }

    function posts() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var tournament_slug = $(element).parents('tr').attr('data-tournament-slug');
        var route = routePosts.replace(':TOURNAMENT_SLUG', tournament_slug).replace(':SEASON_SLUG', slug);
        var url = route;
        window.location.href=url;
    }

    function cash() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var tournament_slug = $(element).parents('tr').attr('data-tournament-slug');
        var route = routeCash.replace(':TOURNAMENT_SLUG', tournament_slug).replace(':SEASON_SLUG', slug);
        var url = route;
        window.location.href=url;
    }

    function transfers() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var tournament_slug = $(element).parents('tr').attr('data-tournament-slug');
        var route = routeTransfers.replace(':TOURNAMENT_SLUG', tournament_slug).replace(':SEASON_SLUG', slug);
        var url = route;
        window.location.href=url;
    }

</script>
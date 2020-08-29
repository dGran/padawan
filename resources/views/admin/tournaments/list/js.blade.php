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
                var element = $(".mark:checked");
                var season = $(element).parents('tr').attr('data-one_s');
                var competition = $(element).parents('tr').attr('data-one_sc');
                var phase = $(element).parents('tr').attr('data-one_scp');
                var group = $(element).parents('tr').attr('data-one_scpg');
                $(".selected-regs-count").text($(".mark:checked").parents('tr').attr('data-name'));
                $("#edit").show();
                $("#seasons").show();
                if (season && competition && phase && group) {
                    $("#participants").show();
                    $("#competition").show();
                } else {
                    $("#participants").hide();
                    $("#competition").hide();
                }
                $("#view").show();
                $("#destroy").removeClass('hint--top-right');
                $("#destroy").addClass('hint--top');
            } else {
                $(".selected-regs-count").text(elements + ' registros seleccionados');
                $("#edit").hide();
                $("#seasons").hide();
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

    function seasons() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routeSeasons;
        var url = route.replace(':SLUG', slug);
        window.location.href=url;
        admin.seasons
    }

    function competition() {
        var element = $(".mark:checked");
        var mode = $(element).parents('tr').attr('data-one_mode');
        if (mode == 'league') {
            var routeCompetition = "{{ route('admin.league.config', [':TOURNAMENT', ':SEASON', ':COMPETITION', ':PHASE', ':GROUP']) }}";
        }
        if (mode == 'playoff') {
            var routeCompetition = "{{ route('admin.playoff.config', [':TOURNAMENT', ':SEASON', ':COMPETITION', ':PHASE', ':GROUP']) }}";
        }
        if (mode == 'race') {
            var routeCompetition = "{{ route('admin.racing.config', [':TOURNAMENT', ':SEASON', ':COMPETITION', ':PHASE', ':GROUP']) }}";
        }
        var tournament = $(element).parents('tr').attr('data-slug');
        var season = $(element).parents('tr').attr('data-one_s');
        var competition = $(element).parents('tr').attr('data-one_sc');
        var phase = $(element).parents('tr').attr('data-one_scp');
        var group = $(element).parents('tr').attr('data-one_scpg');
        var route = routeCompetition;
        var url = route.replace(':TOURNAMENT', tournament).replace(':SEASON', season).replace(':COMPETITION', competition).replace(':PHASE', phase).replace(':GROUP', group);
        window.location.href=url;
    }
</script>
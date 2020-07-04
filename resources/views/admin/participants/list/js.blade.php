<script>
    var routeAdd = "{{ route('admin.participants.add', [$tournament, $season->slug]) }}";
    var routeEdit = "{{ route('admin.participants.edit', [$tournament, $season->slug, ':ID']) }}";
    var routeDestroy = "{{ route('admin.participants.destroy', [$tournament, $season->slug, ':IDS']) }}";
    var routeView = "{{ route('admin.participants.view', [$tournament, $season->slug, ':ID']) }}";
    var routeDuplicate = "{{ route('admin.participants.duplicate', [$tournament, $season->slug, ':IDS']) }}";
    var routeExport = "{{ route('admin.participants.export', [$tournament, $season->slug, ':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.participants.export.global', [$tournament, $season->slug, ':FORMAT', ':FILENAME', $order]) }}";

    {{-- var routeCompetitions = "{{ route('admin.participants', ':SLUG') }}"; --}}
    {{-- var routeParticipants = "{{ route('admin.participants', ':SLUG') }}"; --}}

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
                $("#competitions").show();
                $("#participants").show();
                $("#news").show();
                $("#view").show();
                $("#destroy").removeClass('hint--top-right');
                $("#destroy").addClass('hint--top');
            } else {
                $(".selected-regs-count").text(elements + ' registros seleccionados');
                $("#edit").hide();
                $("#competitions").hide();
                $("#participants").hide();
                $("#news").hide();
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

    function competitions() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routeCompetitions;
        var url = route.replace(':SLUG', slug);
        window.location.href=url;
    }

    function participants() {
        var element = $(".mark:checked");
        var slug = $(element).parents('tr').attr('data-slug');
        var route = routeParticipants;
        var url = route.replace(':SLUG', slug);
        window.location.href=url;
    }
</script>
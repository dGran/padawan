<script>
    var routeAdd = "{{ route('admin.seasons.add', $tournament->slug) }}";
    {{-- var routeEdit = "{{ route('admin.seasons.edit', ':ID') }}"; --}}
    {{-- var routeDestroy = "{{ route('admin.seasons.destroy', ':IDS') }}"; --}}
    var routeView = "{{ route('admin.seasons.view', [$tournament->slug, ':ID']) }}";
    {{-- var routeDuplicate = "{{ route('admin.seasons.duplicate', ':IDS') }}"; --}}
    {{-- var routeExport = "{{ route('admin.seasons.export', [':FORMAT', ':IDS', ':FILENAME', $order]) }}"; --}}
    {{-- var routeExportGlobal = "{{ route('admin.seasons.export.global', [':FORMAT', ':FILENAME', $order]) }}"; --}}

    {{-- var routeCompetitions = "{{ route('admin.seasons', ':SLUG') }}"; --}}
    {{-- var routeParticipants = "{{ route('admin.seasons', ':SLUG') }}"; --}}

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
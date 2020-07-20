<script>
    var routeAdd = "{{ route('admin.groups_participants.add', [$tournament, $season, $competition, $phase, $group]) }}";
    var routeEdit = "{{ route('admin.groups_participants.edit', [$tournament, $season, $competition, $phase, $group, ':ID']) }}";
    var routeDestroy = "{{ route('admin.groups_participants.destroy', [$tournament, $season, $competition, $phase, $group, ':IDS']) }}";
    var routeView = "{{ route('admin.groups_participants.view', [$tournament, $season, $competition, $phase, $group, ':ID']) }}";
    var routeExport = "{{ route('admin.groups_participants.export', [$tournament, $season, $competition, $phase, $group, ':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.groups_participants.export.global', [$tournament, $season, $competition, $phase, $group, ':FORMAT', ':FILENAME', $order]) }}";

    var max_registers = "{{ $group->num_participants }}";
    var current_registers = "{{ $group->participants->count() }}";

    check_max_participants();
    function check_max_participants() {
        var full = "{{ $group->fullParticipants() }}";
        if (full) {
            $(".add").addClass('disable');
        } else {
            $(".add").removeClass('disable');
        }

        $(".current-registers").text(current_registers);
        $(".max-registers").text(max_registers);
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
                $("#view").show();
                $("#destroy").removeClass('hint--top-right');
                $("#destroy").addClass('hint--top');
            } else {
                $(".selected-regs-count").text(elements + ' registros seleccionados');
                $("#edit").hide();
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

</script>
<script>
    var routeAdd = "{{ route('admin.participants.add', [$tournament, $season]) }}";
    var routeEdit = "{{ route('admin.participants.edit', [$tournament, $season, ':ID']) }}";
    var routeDestroy = "{{ route('admin.participants.destroy', [$tournament, $season, ':IDS']) }}";
    var routeView = "{{ route('admin.participants.view', [$tournament, $season, ':ID']) }}";
    var routeExport = "{{ route('admin.participants.export', [$tournament, $season, ':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.participants.export.global', [$tournament, $season, ':FORMAT', ':FILENAME', $order]) }}";

    var routeKick = "{{ route('admin.participants.kick', [$tournament, $season, ':ID']) }}";
    var routeReplace = "{{ route('admin.participants.replace', [$tournament, $season, ':ID']) }}";

    var routeGenerateParticipants = "{{ route('admin.participants.generate_participants', [$tournament, $season]) }}";

    var max_registers = "{{ $season->num_participants }}";
    var current_registers = "{{ $season->participants->count() }}";
    check_max_participants();

    function check_max_participants() {
        var full = "{{ $season->fullParticipants() }}";
        if (full) {
            $(".add").addClass('disable');
            $("#generate_participants").addClass('disable');
        } else {
            $(".add").removeClass('disable');
            $("#generate_participants").removeClass('disable');
        }
        if ("{{ $season->num_participants == 0 }}") {
            $("#generate_participants").addClass('disable');
        }

        $(".current-registers").text(current_registers);
        $(".max-registers").text(max_registers);
    }

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
                var user_id = $(element).parents('tr').attr('data-user_id');
                var eteam_id = $(element).parents('tr').attr('data-eteam_id');
                var season_state = "{{ $season->state }}";
                var season_reserves = "{{ $season->reserves->count() }}";

                $(".selected-regs-count").text($(".mark:checked").parents('tr').attr('data-name'));
                $("#edit").show();
                $("#kick").show();
                $("#replace").show();
                if ((user_id > 0 || eteam_id > 0) && season_state == 'active') {
                    $("#kick").removeClass('disable');
                    if (season_reserves > 0) {
                        $("#replace").removeClass('disable');
                    }
                } else {
                    $("#kick").addClass('disable');
                    $("#replace").addClass('disable');
                }
                $("#view").show();
                $("#destroy").removeClass('hint--top-right');
                $("#destroy").addClass('hint--top');
            } else {
                $(".selected-regs-count").text(elements + ' registros seleccionados');
                $("#edit").hide();
                $("#kick").hide();
                $("#replace").hide();
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

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });

    function kick() {
        var element = $(".mark:checked");
        var name = $(element).parents('tr').attr('data-name_without_team');
        var id = $(element).parents('tr').attr('data-id');
        disabledActionsButtons();
        swal({
            title: "Confirmación de expulsión",
            text: 'Se va a expulsar a ' + name + ' de la lista de participantes. No se podrán deshacer los cambios!',
            buttons: {
                confirm: {
                    text: "Expulsar",
                    value: true,
                    visible: true,
                    className: "swal-btn danger",
                    closeModal: true
                },
                cancel: {
                    text: "Cancelar",
                    value: null,
                    visible: true,
                    className: "swal-btn default",
                    closeModal: true,
                }
            },
            closeOnClickOutside: false,
        })
        .then((value) => {
            if (value) {
                var route = routeKick.replace(':ID', id);
                var url = route;
                window.location.href=url;
            } else {
                enabledActionsButtons();
            }
        });
    }

    function replace() {
        var element = $(".mark:checked");
        var id = $(element).parents('tr').attr('data-id');
        var route = routeReplace.replace(':ID', id);
        var url = route;
        window.location.href=url;
    }

    function generateParticipants() {
        var url = routeGenerateParticipants;
        window.location.href=url;
    }
</script>
<script>
    var routeAdd = "{{ route('admin.participants.add', [$tournament, $season]) }}";
    var routeEdit = "{{ route('admin.participants.edit', [$tournament, $season, ':ID']) }}";
    var routeDestroy = "{{ route('admin.participants.destroy', [$tournament, $season, ':IDS']) }}";
    var routeView = "{{ route('admin.participants.view', [$tournament, $season, ':ID']) }}";
    var routeExport = "{{ route('admin.participants.export', [$tournament, $season, ':FORMAT', ':IDS', ':FILENAME', $order]) }}";
    var routeExportGlobal = "{{ route('admin.participants.export.global', [$tournament, $season, ':FORMAT', ':FILENAME', $order]) }}";

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

    $("#form-filter").submit(function(event) {
        disabledActionsButtons();
    });

    function generateParticipants() {
        var url = routeGenerateParticipants;
        window.location.href=url;
    }
</script>
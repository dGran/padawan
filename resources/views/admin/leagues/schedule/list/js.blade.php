<script>
	var routeEdit = "{{ route('admin.racing.schedule.races.edit', [$tournament, $season, $competition, $phase, $group, ':ID']) }}";
	var routeDestroy = "{{ route('admin.racing.schedule.races.destroy', [$tournament, $season, $competition, $phase, $group, ':ID']) }}";
    var routeEditResults = "{{ route('admin.racing.schedule.races.edit.results', [$tournament, $season, $competition, $phase, $group, ':ID']) }}";
    var routeVideos = "{{ route('admin.racing.schedule.races.videos', [$tournament, $season, $competition, $phase, $group, ':ID']) }}";

    //edit
    function edit(id) {
        var route = routeEdit;
        var url = route.replace(':ID', id);
        window.location.href=url;
    }

    function editResults(id) {
        var route = routeEditResults;
        var url = route.replace(':ID', id);
        window.location.href=url;
    }

    function videos(id) {
        var route = routeVideos;
        var url = route.replace(':ID', id);
        window.location.href=url;
    }

    //destroy
    function destroy(id, name) {
        disabledActionsButtons();
        swal({
            title: "Confirmación de borrado",
            text: 'Se va a eliminar la carrera "' + name + '". No se podrán deshacer los cambios!',
            buttons: {
                confirm: {
                    text: "Eliminar",
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
                var route = routeDestroy;
                var url = route.replace(':ID', id);
                window.location.href=url;
            } else {
                enabledActionsButtons();
            }
        });
    }
</script>
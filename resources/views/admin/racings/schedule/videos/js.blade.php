<script>
	var routeEdit = "{{ route('admin.racing.schedule.races.videos.edit', [$tournament, $season, $competition, $phase, $group, $race->id, ':ID']) }}";
	var routeDestroy = "{{ route('admin.racing.schedule.races.videos.destroy', [$tournament, $season, $competition, $phase, $group, $race->id, ':ID']) }}";

    //edit
    function edit(id) {
        var route = routeEdit;
        var url = route.replace(':ID', id);
        window.location.href=url;
    }

    //destroy
    function destroy(id) {
        disabledActionsButtons();
        swal({
            title: "Confirmación de borrado",
            text: 'Se va a eliminar el video. No se podrán deshacer los cambios!',
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
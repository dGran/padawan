<script>
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	function update_result(id) {
        var position = $("#position"+id).val();
        var time = $("#time"+id).val();
        var fastest_lap = $("#fastest_lap"+id).val();
        var sanction = $("#sanction"+id).val();
        var route = "{{ route('admin.racing.schedule.races.update.results', [':ID']) }}"
        var url = route.replace(':ID', id);

        $.ajax({
			url: url,
			method: 'POST',
			data: {
				_token: CSRF_TOKEN,
           		position: position,
                time: time,
                fastest_lap: fastest_lap,
                sanction: sanction
           	},
			success:function(data) {
				$("#position" + id).val(data['position']);
                $("#time" + id).val(data['time']);
                $("#fastest_lap" + id).val(data['fastest_lap']);
                $("#sanction" + id).val(data['sanction']);
			}
		});
	}

    function reset(id) {
        disabledActionsButtons();
        swal({
            title: "Confirmación de reseteo",
            text: 'Se van a resetear los resultados de la carrera. No se podrán deshacer los cambios!',
            buttons: {
                confirm: {
                    text: "Resetear",
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
            	$(".position").val(0);
		        var route = "{{ route('admin.racing.schedule.races.reset.results', [':ID']) }}"
		        var url = route.replace(':ID', id);

		        $.ajax({
					url: url,
					method: 'GET',
					success:function(data) {
						enabledActionsButtons();
					}
				});
            } else {
                enabledActionsButtons();
            }
        });
	}
</script>
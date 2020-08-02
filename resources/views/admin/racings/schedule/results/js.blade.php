<script>
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	function update_result(id) {
        var position = $("#position"+id).val();
        var fastest_lap = 0;
        if ($('#fastest_lap'+id).is(':checked')) {
        	$(".fastest_lap").prop('checked', false);
        	$('#fastest_lap'+id).prop("checked", true);
        	var fastest_lap = 1;
        }
        var pole = 0;
        if ($('#pole'+id).is(':checked')) {
        	$(".pole").prop('checked', false);
        	$('#pole'+id).prop("checked", true);
        	var pole = 1;
        }
        if (position == 0) {
        	$('#fastest_lap'+id).prop("checked", false);
        	$('#pole'+id).prop("checked", false);
        }
        var route = "{{ route('admin.racing.schedule.races.update.results', [':ID']) }}"
        var url = route.replace(':ID', id);

        $.ajax({
			url: url,
			method: 'POST',
			data: {
				_token: CSRF_TOKEN,
           		position: position,
           		fastest_lap: fastest_lap,
           		pole: pole
           	},
			success:function(data) {
				$("#position" + id).val(data['position']);
				if (data['fastest_lap'] == 1) {
					$("#fastest_lap" + id).attr("checked", true);
				}
				if (data['pole'] == 1) {
					$("#pole" + id).attr("checked", true);
				}
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
            	$(".fastest_lap").prop('checked', false);
            	$(".pole").prop('checked', false);
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
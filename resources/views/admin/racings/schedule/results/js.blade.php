<script>
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	function update_result(id) {
        var position = $("#position"+id).val();
        var time = $("#time"+id).val();
        var fastest_lap = $("#fastest_lap"+id).val();
        var sanction = $("#sanction"+id).val();
        var state = $("#state"+id).val();
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
                sanction: sanction,
                state: state
           	},
			success:function(data) {
				$("#position" + id).val(data['position']);
                $("#time" + id).val(data['time']);
                $("#fastest_lap" + id).val(data['fastest_lap']);
                $("#sanction" + id).val(data['sanction']);
                if (data['position'] == 0) {
                    $("#state"+ id + " option[value='finished']").attr('disabled', 'disabled');
                    $("#state"+ id +" option[value='retired']").removeAttr('disabled');
                    $("#state"+ id + " option[value='disqualified']").removeAttr('disabled');
                    $("#state"+ id + " option[value='not_shown']").removeAttr('disabled');

                    if (data['state'] == 'not_shown') {
                        $("#state"+ id + " option[value='not_shown'").attr("selected",true);
                    }
                    if (data['state'] == 'retired') {
                        $("#state"+ id + " option[value='retired'").attr("selected",true);
                    }
                    if (data['state'] == 'disqualified') {
                        $("#state"+ id + " option[value='disqualified'").attr("selected",true);
                    }
                } else {
                    $("#state"+ id + " option[value='finished']").removeAttr('disabled');
                    $("#state"+ id + " option[value='retired']").attr('disabled', 'disabled');
                    $("#state"+ id + " option[value='disqualified']").attr('disabled', 'disabled');
                    $("#state"+ id + " option[value='not_shown']").attr('disabled', 'disabled');

                    $("#state"+ id + " option[value='finished'").attr("selected",true);
                }
			}
		});
	}

    function reset(id, type) {
        disabledActionsButtons();
        swal({
            title: "Confirmación de reseteo",
            text: 'Se van a resetear todos los resultados. No se podrán deshacer los cambios!',
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
		        var route = "{{ route('admin.racing.schedule.races.reset.results', [':ID', ':TYPE']) }}"
		        var url = route.replace(':ID', id).replace(':TYPE', type);
                window.location.href=url;
            } else {
                enabledActionsButtons();
            }
        });
	}
</script>
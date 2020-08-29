<script>
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	function check_fastest_lap() {
		if ($('#fastest_lap').is(':checked')) {
			$('#score_fastest_lap').removeClass('disable');
			$('#score_fastest_lap').focus().select();
		} else {
			$('#score_fastest_lap').addClass('disable');
			$('#score_fastest_lap').val('0');
		}
	}

	function check_pre_qualying() {
		if ($('#pre_qualifying').is(':checked')) {
			$('#qualifying').prop('checked', true);
			$('#score_pole').removeClass('disable');
			$('#score_pole').focus().select();
		}
	}

	function check_qualying() {
		if ($('#qualifying').is(':checked')) {
			$('#score_pole').removeClass('disable');
			$('#score_pole').focus();
		} else {
			$('#score_pole').addClass('disable');
			$('#score_pole').val('0');
			$('#pre_qualifying').prop('checked', false);
		}
	}

	function update_score(id) {
        var score = $("#score"+id).val();
        var route = "{{ route('admin.racing.config.update.score', [':ID']) }}"
        var url = route.replace(':ID', id);

        $.ajax({
			url: url,
			method: 'POST',
			data: {
				_token: CSRF_TOKEN,
           		score: score
           	},
			success:function(data){
				$("#score" + id).val(data);
			}
		});
	}
</script>
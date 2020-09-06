<script>
	function check_draws() {
		if ($('#allow_draws').is(':checked')) {
			$('#draw_points').removeClass('disable');
			$('#draw_amount').removeClass('disable');
		} else {
			$('#draw_points').addClass('disable');
			$('#draw_points').val('');
			$('#draw_amount').addClass('disable');
			$('#draw_amount').val('');
		}
	}
</script>
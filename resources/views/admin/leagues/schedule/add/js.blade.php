<script>

	$('#pre_qualifying').change(function() {
		if ($(this).is(':checked')) {
			$('#qualifying').prop('checked', true);
		}
	});

	$('#qualifying').change(function() {
		if (!$(this).is(':checked')) {
			$('#pre_qualifying').prop('checked', false);
		}
	});

</script>
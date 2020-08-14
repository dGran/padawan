<script>
	function participants_change_view(view) {
		if (view == 'list') {
			$("#participants_list_view").removeClass('hidden');
			$("#participants_card_view").addClass('hidden');
			$("#participants_card_view_button").removeClass('active');
			$("#participants_list_view_button").addClass('active');
		} else {
			$("#participants_card_view").removeClass('hidden');
			$("#participants_list_view").addClass('hidden');
			$("#participants_list_view_button").removeClass('active');
			$("#participants_card_view_button").addClass('active');
		}
	}

	function reserves_change_view(view) {
		if (view == 'list') {
			$("#reserves_list_view").removeClass('hidden');
			$("#reserves_card_view").addClass('hidden');
			$("#reserves_card_view_button").removeClass('active');
			$("#reserves_list_view_button").addClass('active');
		} else {
			$("#reserves_card_view").removeClass('hidden');
			$("#reserves_list_view").addClass('hidden');
			$("#reserves_list_view_button").removeClass('active');
			$("#reserves_card_view_button").addClass('active');
		}
	}
</script>
<script>
	function show_details(id)
	{
		$('#detail'+id).removeClass('fadeOut hidden');
		$('#detail'+id).addClass('fadeIn');
	}

	function hide_details(id)
	{
		$('#detail'+id).removeClass('fadeIn');
		$('#detail'+id).addClass('fadeOut');
	}
</script>
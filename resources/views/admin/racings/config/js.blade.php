<script>
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

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

    function submit_form_update_score(id) {
	}
</script>
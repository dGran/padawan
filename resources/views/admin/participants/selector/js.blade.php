<script>
	loadSeasons();

    function loadSeasons() {
        var route = "{{ route('admin.participants.load_seasons', ':ID') }}";
        var id = $("#tournament_id option:selected").val();
        var url = route.replace(':ID', id);
        if (id == 0) {
        	$('#season_slug').find('option').remove().end().append('<option>No existen temporadas</option>');
        	$('#season_slug').addClass("disable");
        } else {
	        $.ajax({
	            url         : url,
	            type        : 'GET',
	            datatype    : 'html',
	        }).done(function(data){
	        	if (data) {
	            	$('#season_slug').html(data);
	            	$('#season_slug').removeClass("disable");
	        	} else {
	            	$('#season_slug').html('<option value="">No existen temporadas</option>');
	            	$('#season_slug').addClass("disable");
	        	}
	        });
        }
    }

    // $("#form-selector").submit(function(event) {
    //     disabledActionsButtons();
    //     if ($('#season_slug').hasClass
    // });
</script>
<script>
	loadPositions();

	function showImage(fileInput) {
		thumbnail.src = '{{ asset('img/players/default.png') }}';
		deleteImg.value = 0;

		var files = fileInput.files;
		for (var i = 0; i < files.length; i++) {
			var file = files[i];
			var imageType = /image.*/;
			if (!file.type.match(imageType)) {
				continue;
			}
			var img=document.getElementById("thumbnail");
			img.file = file;
			var reader = new FileReader();
			reader.onload = (function(aImg) {
				return function(e) {
					aImg.src = e.target.result;
				};
			})(img);
			reader.readAsDataURL(file);
		}
		$('#delete_img').removeClass('hidden');
	}

	function deleteImage() {
		var thumbnail = document.getElementById("thumbnail");
		var deleteImg = document.getElementById("deleteImg");

		thumbnail.src = '{{ asset('img/players/default.png') }}';
		deleteImg.value = 1;

		$('#delete_img').addClass('hidden');
	}

    function loadPositions() {
        $('#loading').removeClass("hidden");
        var route = "{{ route('admin.players.load_positions', [':ID', 'edit', $player->position_id]) }}";
        var id = $("#players_databases_id option:selected").val();
        var url = route.replace(':ID', id);
        if (id == 0) {
        	$('#position_id').find('option').remove().end().append('<option>Database no seleccionada</option>');
        	$('#position_id').addClass("disable");
        } else {
	        $.ajax({
	            url         : url,
	            type        : 'GET',
	            datatype    : 'html',
	        }).done(function(data){
	            $('#position_id').html(data);
	            $('#position_id').removeClass("disable");
	        });
        }
        $('#loading').addClass("hidden");
    }

    $("#form-edit").submit(function(event) {
        disabledActionsButtons();
    });
</script>
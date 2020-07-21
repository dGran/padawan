<script>
	function showImage(fileInput) {
		thumbnail.src = '{{ asset('img/competitions/default.png') }}';
		deleteImage.value = 0;

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

		thumbnail.src = '{{ asset('img/competitions/default.png') }}';
		deleteImg.value = 1;

		$('#delete_img').addClass('hidden');
	}

    $("#form-add").submit(function(event) {
        disabledActionsButtons();
    });

    function auto_generate_league_change()
    {
    	if ($("#auto_generate_league").prop('checked')) {
    		$("#auto_generate_playoff").prop('checked', false);
    		$("#auto_generate_race").prop('checked', false);
		}
    }

    function auto_generate_playoff_change()
    {
    	if ($("#auto_generate_playoff").prop('checked')) {
    		$("#auto_generate_league").prop('checked', false);
    		$("#auto_generate_race").prop('checked', false);
		}
    }

    function auto_generate_race_change()
    {
    	if ($("#auto_generate_race").prop('checked')) {
    		$("#auto_generate_league").prop('checked', false);
    		$("#auto_generate_playoff").prop('checked', false);
		}
    }
</script>
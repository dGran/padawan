<script>
	function showImage(fileInput) {
		thumbnail.src = '{{ asset('img/platforms/default.png') }}';
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

		thumbnail.src = '{{ asset('img/platforms/default.png') }}';
		deleteImg.value = 1;

		$('#delete_img').addClass('hidden');
	}

    $("#form-add").submit(function(event) {
        disabledActionsButtons();
    });
</script>
<script>
	function showImage(fileInput) {
		thumbnail.src = '{{ asset('img/avatars/default.png') }}';
		deleteAvatar.value = 0;

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
		$('#delete_avatar').removeClass('hidden');
	}

	function deleteImage() {
		var thumbnail = document.getElementById("thumbnail");
		var deleteAvatar = document.getElementById("deleteAvatar");

		thumbnail.src = '{{ asset('img/avatars/default.png') }}';
		deleteAvatar.value = 1;

		$('#delete_avatar').addClass('hidden');
	}

    $("#form-add").submit(function(event) {
        disabledActionsButtons();
    });
</script>
<script>

    $("#form-edit").submit(function(event) {
        disabledActionsButtons();
    });

	function showImage(fileInput) {
		var thumbnail = document.getElementById("thumbnail");
		var deleteImg = document.getElementById("deleteImg");

		thumbnail.src = '{{ asset('img/games/default.png') }}';
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

		thumbnail.src = '{{ asset('img/games/default.png') }}';
		deleteImg.value = 1;

		$('#delete_img').addClass('hidden');
	}

	function showBanner(fileInput) {
		var thumbnailBanner = document.getElementById("thumbnail_banner");
		var deleteBanner = document.getElementById("deleteBanner");

		thumbnailBanner.src = '{{ asset('img/games/default_banner.png') }}';
		deleteBanner.value = 0;

		var files = fileInput.files;
		for (var i = 0; i < files.length; i++) {
			var file = files[i];
			var imageType = /image.*/;
			if (!file.type.match(imageType)) {
				continue;
			}
			var img=document.getElementById("thumbnail_banner");
			img.file = file;
			var reader = new FileReader();
			reader.onload = (function(aImg) {
				return function(e) {
					aImg.src = e.target.result;
				};
			})(img);
			reader.readAsDataURL(file);
		}
		$('#delete_banner').removeClass('hidden');
	}

	function deleteBanner() {
		var thumbnailBanner = document.getElementById("thumbnail_banner");
		var deleteBanner = document.getElementById("deleteBanner");

		thumbnailBanner.src = '{{ asset('img/games/default_banner.png') }}';
		deleteBanner.value = 1;

		$('#delete_banner').addClass('hidden');
	}

</script>
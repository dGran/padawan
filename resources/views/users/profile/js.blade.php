<script type="text/javascript">
	function changeAtiveTab(event,tabID){
		let element = event.target;
		while(element.nodeName !== "A"){
			element = element.parentNode;
		}
		ulElement = element.parentNode.parentNode;
		aElements = ulElement.querySelectorAll("li > a");
		tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
		for(let i = 0 ; i < aElements.length; i++){
			aElements[i].classList.remove("text-white");
			aElements[i].classList.remove("bg-gray-600");
			aElements[i].classList.add("text-gray-600");
			aElements[i].classList.add("bg-white");
			tabContents[i].classList.add("hidden");
			tabContents[i].classList.remove("block");
		}
		element.classList.remove("text-gray-600");
		element.classList.remove("bg-white");
		element.classList.add("text-white");
		element.classList.add("bg-gray-600");
		document.getElementById(tabID).classList.remove("hidden");
		document.getElementById(tabID).classList.add("block");
	}

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
</script>